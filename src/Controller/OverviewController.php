<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class OverviewController extends AbstractController
{
    #[Route('/', name: 'app_overview')]
    public function index(): Response
    {
        $session = new Session();
        $name = $session->get('name');
        $prefix = $session->get('prefix');
        $suffix = $session->get('suffix');

        if(empty($name) || !strlen($name)) {
            return $this->redirectToRoute('app_configurator_name');
        }

        $eastereggActive = false;
        if($prefix == 'König' && $name == 'Thomas' && $suffix == 'der Heilige') {
            $eastereggActive = true;
        }

        return $this->render('overview/index.html.twig', [
            'prefix' => $prefix,
            'name' => $name,
            'suffix' => $suffix,
            'easteregg' => $eastereggActive
        ]);
    }
}
