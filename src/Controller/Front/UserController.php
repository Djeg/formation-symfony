<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Form\SubscriptionType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    /**
     * @Route("/inscription", name="app_front_user_subscription")
     */
    public function subscription(Request $request): Response
    {
        $form = $this->createForm(SubscriptionType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // on verra un peu plus tard ...
        }

        return $this->render('front/user/subscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
