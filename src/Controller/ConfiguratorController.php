<?php

namespace App\Controller;

use App\Entity\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class ConfiguratorController extends AbstractController
{
    #[Route('/configurator/prefix', name: 'app_configurator_prefix')]
    public function prefix(Request $request): Response
    {
        $session = new Session();

        $name = new Name();
        $name->setPrefix('');

        if($savedPrefix = $session->get('prefix')) {
            $name->setPrefix($savedPrefix);
        }

        $form = $this->createFormBuilder($name)
            ->add('prefix', ChoiceType::class, [
                'choices' => [
                    'König' => 'König',
                    'Königin' => 'Königin',
                    'Offizier' => 'Offizier',
                    'Doktor' => 'Doktor',
                    'Herr' => 'Herr',
                    'Frau' => 'Frau',
                    'General' => 'General'
                ],
            ])
            ->add('save', SubmitType::class, ['label' => 'Speichern'])
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $name->setPrefix($form['prefix']->getData());
            $session->set('prefix', $name->getPrefix());
            return $this->redirectToRoute('app_overview');
        }

        return $this->render('configurator/prefix.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/configurator/name', name: 'app_configurator_name')]
    public function name(Request $request): Response
    {
        $session = new Session();

        $name = new Name();
        $name->setName('');

        if($savedName = $session->get('name')) {
            $name->setName($savedName);
        }

        $form = $this->createFormBuilder($name)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Speichern'])
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $name->setName($form['name']->getData());
            $session->set('name', $name->getName());
            return $this->redirectToRoute('app_overview');
        }

        return $this->render('configurator/name.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/configurator/suffix', name: 'app_configurator_suffix')]
    public function suffix(Request $request): Response
    {
        $session = new Session();

        $name = new Name();
        $name->setSuffix('');

        if($savedPrefix = $session->get('suffix')) {
            $name->setSuffix($savedPrefix);
        }

        $form = $this->createFormBuilder($name)
            ->add('suffix', ChoiceType::class, [
                'choices' => [
                    'der Grosse' => 'der Grosse',
                    'die Grosse' => 'die Grosse',
                    'der Verrückte' => 'der Verrückte',
                    'die Verrückte' => 'die Verrückte',
                    'der Heilige' => 'der Heilige',
                    'die Heilige' => 'die Heilige',
                    'der Besoffene' => 'der Besoffene',
                    'die Besoffene' => 'die Besoffene'
                ],
                'expanded' => true,
            ])
            ->add('save', SubmitType::class, ['label' => 'Speichern'])
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $name->setSuffix($form['suffix']->getData());
            $session->set('suffix', $name->getSuffix());
            return $this->redirectToRoute('app_overview');
        }

        return $this->render('configurator/suffix.html.twig', [
            'form' => $form,
        ]);
    }
}
