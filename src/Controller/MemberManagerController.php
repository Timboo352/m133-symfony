<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MemberManagerController extends AbstractController
{
    #[Route('/member/manager', name: 'app_member_manager')]
    public function index(): Response
    {
        return $this->render('member_manager/index.html.twig', [
            'controller_name' => 'MemberManagerController',
        ]);
    }
}
