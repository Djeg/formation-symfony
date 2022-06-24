<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Pizza;
use App\Repository\BasketRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class BasketController extends AbstractController
{
    #[Route('/mon-panier', name: 'app_basket_display')]
    public function display(): Response
    {
        return $this->render('basket/display.html.twig');
    }

    #[Route('/mon-panier/{id}/ajouter', name: 'app_basket_addArticle')]
    public function addArticle(Pizza $pizza, BasketRepository $repository): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $basket = $user->getBasket();

        $article = new Article();
        $article->setQuantity(1);
        $article->setBasket($basket);
        $article->setPizza($pizza);

        $basket->addArticle($article);

        $repository->add($basket, true);

        return $this->redirectToRoute('app_basket_display');
    }
}
