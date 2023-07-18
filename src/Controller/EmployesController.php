<?php

namespace App\Controller;

use App\Entity\Employes;
use App\Form\EmployeType;
use App\Repository\EmployesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmployesController extends AbstractController
{
    #[Route('/employes', name: 'app_employes')]
    public function index(EmployesRepository $employesRepository): Response
    {
        $employes = $employesRepository->findAll();
        return $this->render('employes/index.html.twig', [
            'employes' => $employes
        ]);
    }


    #[Route('/employes/new', name: 'app_employes_new')]
    public function new(Request $request, EntityManagerInterface $entitymanager): Response
    {
        $employes = new Employes();

        $form = $this->createForm(EmployeType::class, $employes);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $entitymanager->persist($employes);
            $entitymanager->flush();
        }


        return $this->render('employes/new.html.twig', [
            'form' => $form


        ]);
    }
}
