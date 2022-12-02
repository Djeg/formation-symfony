<?php

namespace App\Repository;

use App\DTO\AccountSearchCriteria;
use App\Entity\Account;
use App\Repository\Helper\BuildPagination;
use App\Repository\Helper\BuildSort;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<Account>
 *
 * @method Account|null find($id, $lockMode = null, $lockVersion = null)
 * @method Account|null findOneBy(array $criteria, array $orderBy = null)
 * @method Account[]    findAll()
 * @method Account[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    use BuildPagination;
    use BuildSort;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Account::class);
    }

    public function save(Account $entity, bool $flush = false): void
    {
        $entity->setUpdatedAt(new DateTime());

        if (!$entity->getCreatedAt()) {
            $entity->setCreatedAt(new DateTime());
        }

        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Account $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Account) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->save($user, true);
    }

    /**
     * Récupére la liste des comptes en fonction de critére de recherche
     */
    public function findAllBySearchCriteria(AccountSearchCriteria $criteria): array
    {
        $qb = $this->createQueryBuilder('account');

        $this
            ->buildSort($qb, 'account', $criteria)
            ->buildPagination($qb, $criteria);

        if ($criteria->email) {
            $qb->andWhere('account.email LIKE :email')->setParameter('email', "%{$criteria->email}%");
        }

        return $qb->getQuery()->getResult();
    }
}
