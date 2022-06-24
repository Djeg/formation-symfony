<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Payment;
use App\Entity\Order;
use App\Entity\User;
use App\Form\PaymentType;
use App\Repository\OrderRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class OrderController extends AbstractController
{
    #[Route('/commander', name: 'app_order_display')]
    public function display(Request $request, OrderRepository $repository): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $payment = new Payment();
        $payment->address = $user->getAddress();

        $form = $this->createForm(PaymentType::class, $payment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Création de la commande !
            $order = new Order();
            $order->setUser($user);
            $order->setAddress($payment->address);

            foreach ($user->getBasket()->getArticles() as $article) {
                $order->addArticle($article);
            }

            $repository->add($order, true);

            return $this->redirectToRoute('app_order_validate', [
                'id' => $order->getId(),
            ]);
        }

        return $this->render('order/display.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/commander/{id}/validation', name: 'app_order_validate')]
    public function validate(Order $order): Response
    {
        return $this->render('order/validate.html.twig', [
            'order' => $order,
        ]);
    }
}
