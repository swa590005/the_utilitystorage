<?php

namespace App\Controller;


use App\Entity\Heater;
use App\Repository\HeaterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\HeaterFormType;

class AdminHeaterController extends AbstractController
{
    /**
     * @Route("/admin/heater/new", name="admin_heater_new")
     */
    public function new(EntityManagerInterface $em, Request $request):Response
    {
        $form = $this->createForm(HeaterFormType::class);

        //handle request comes into picture during post
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $heater=$form->getData();
            $em->persist($heater);
            $em->flush();
            $this->addFlash('success', 'Heater Created!');
            return $this->redirectToRoute('admin_heater_list');

        }

        return $this->render('admin_heater/new.html.twig', [
            'heaterForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/heater/{id}/edit", name="admin_heater_edit")
     */
    public function edit(Heater $heater, EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(HeaterFormType::class, $heater);

        //handle request comes into picture during post
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($heater);
            $em->flush();

            $this->addFlash('success', 'Heater Updated!');
            return $this->redirectToRoute('admin_heater_list');

        }
        return $this->render('admin_heater/edit.html.twig', [
            'heaterForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/heater/{id}/delete", name="admin_heater_delete")
     */
    public function delete(HeaterRepository $heaterRepository, EntityManagerInterface $em, $id)
    {
        $heater=$heaterRepository->find($id);
        $heater->setIsDeleted(true);
        $em->persist($heater);
        $em->flush();

        return $this->redirectToRoute('admin_heater_list');
    }

    /**
     * @Route("/admin/heater", name="admin_heater_list")
     */
    public function list(HeaterRepository $heaterRepository): Response
    {
        $heaters=$heaterRepository->findAllNonDeletedHeater();
        return $this->render('admin_heater/list.html.twig',[
            'heaters'=>$heaters,
        ]);
    }

}
