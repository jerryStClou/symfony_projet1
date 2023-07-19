<?php

namespace App\Controller;

use App\Entity\Employes;
use App\Form\EmployeType;
use App\Repository\EmployesRepository;
use Doctrine\ORM\EntityManager;
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
            $this->redirectToRoute('app_employes');
        }


        return $this->render('employes/new.html.twig', [
            'form' => $form
        ]);
        return $this->redirectToRoute('app_employes');
    }



    #[Route('/employes/edit/{id}', name: 'app_employes_edit')]
    public function edit(EmployesRepository $employesRepository, $id, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $employes = $employesRepository->find($id);

        $form = $this->createForm(EmployeType::class, $employes);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManagerInterface->persist($employes);
            $entityManagerInterface->flush();
            $this->redirectToRoute('app_employes');
        }

        return $this->render('employes/edit.html.twig', [
            'form' => $form
        ]);
    }


    #[Route('/employes/delete/{id}', name: 'app_employes_delete')]
    public function delete($id, EmployesRepository $employesRepository, EntityManagerInterface $entityManagerInterface)
    {
        $employes = $employesRepository->find($id);

        $entityManagerInterface->remove($employes);
        $entityManagerInterface->flush();

        return $this->redirectToRoute('app_employes');
    }


    #[Route('/employes/show/{id}', name: 'app_employes_show')]
    public function show(EmployesRepository $employesRepository, $id): Response
    {
        $employes = $employesRepository->find($id);
        return $this->render('employes/show.html.twig', ['employe' => $employes]);
    }
}
