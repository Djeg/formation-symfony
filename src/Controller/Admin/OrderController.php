<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Order;
use App\Form\AdminOrderType;
use App\Form\OrderSearchType;
use App\Repository\OrderRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Permet de gérer toutes les commandes du site
 */
#[Route('/admin/orders')]
#[IsGranted('ROLE_ADMIN')]
class OrderController extends AbstractController
{
    /**
     * Liste les commandes de la pizzeria
     */
    #[Route('/', name: 'app_admin_order_retrieve')]
    public function retrieve(OrderRepository $repository, Request $request): Response
    {
        $form = $this->createForm(OrderSearchType::class);

        $form->handleRequest($request);

        $orders = $repository->findAllBySearch($form->getData());

        return $this->render('admin/order/retrieve.html.twig', [
            'orders' => $orders,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Permet de mettre à jour une commande
     */
    #[Route('/{id}', name: 'app_admin_order_update')]
    public function update(
        Order $order,
        OrderRepository $repository,
        Request $request,
    ): Response {
        $form = $this->createForm(AdminOrderType::class, $order);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->add($form->getData());

            return $this->redirectToRoute('app_admin_order_retrieve');
        }

        return $this->render('admin/order/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Permet de supprimer une commande. NOTE : Une commande
     * ne se supprime pas vraiment mais passe au status de
     * annulé :)
     */
    #[Route('/{id}/supprimer', name: 'app_admin_order_delete')]
    public function delete(Order $order, OrderRepository $repository): Response
    {
        $order->setStatus(Order::$STATUS_CANCEL);

        $repository->add($order);

        return $this->redirectToRoute('app_admin_order_retrieve');
    }
}
