<?php

namespace App\Controller;


use App\Entity\Meter;
use App\Repository\MeterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\MeterFormType;

class AdminMeterController extends AbstractController
{
    
    /**
     * @Route("/admin/meter/new", name="admin_meter_new")
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
         $form = $this->createForm(MeterFormType::class);

        //handle request comes into picture during post
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $meter=$form->getData();
            $em->persist($meter);
            $em->flush();
            $this->addFlash('success', 'Meter Created!');

            return $this->redirectToRoute('admin_meter_list');


        }
        return $this->render('admin_meter/new.html.twig', [
            'meterForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/meter/{id}/edit", name="admin_meter_edit")
     */
    public function edit(Meter $meter, EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(MeterFormType::class, $meter);

        //handle request comes into picture during post
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($meter);
            $em->flush();

            $this->addFlash('success', 'Meter Updated!');


            return $this->redirectToRoute('admin_meter_list');

        }
        return $this->render('admin_meter/edit.html.twig', [
            'meterForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/meter/{id}/delete", name="admin_meter_delete")
     */
    public function delete(MeterRepository $meterRepository, EntityManagerInterface $em, $id)
    {
        $meter=$meterRepository->find($id);
        $meter->setIsDeleted(true);
        $em->persist($meter);
        $em->flush();

        return $this->redirectToRoute('admin_meter_list');
    }

    /**
     * @Route("/admin/meter", name="admin_meter_list")
     */
    public function list(MeterRepository $meterRepository): Response
    {
        $meters=$meterRepository->findAllNonDeletedMeter();
        return $this->render('admin_meter/list.html.twig',[
            'meters'=>$meters,
        ]);
    }
} 
