<?php

namespace App\Controller;

use App\Entity\MeterReading;
use App\Form\MeterReadingFormType;
use App\Repository\MeterReadingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMeterReadingController extends AbstractController
{
    /**
     * @Route("/admin/meter/reading/new", name="admin_meter_reading")
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(MeterReadingFormType::class);
        //handle request comes into picture during post
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $meterReading=$form->getData();
            $em->persist($meterReading);
            $em->flush();
            $this->addFlash('success', 'Entry Created!');

            return $this->redirectToRoute('admin_meter_reading_list');

        }
        return $this->render('admin_meter_reading/new.html.twig', [
            'meterReadingForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/meter/reading/{id}/edit", name="admin_meter_reading_edit")
     */
    public function edit(MeterReading $meterReading, EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(MeterReadingFormType::class, $meterReading);

        //handle request comes into picture during post
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($meterReading);
            $em->flush();

            $this->addFlash('success', 'Entry Updated!');


            return $this->redirectToRoute('admin_meter_reading_list');

        }
        return $this->render('admin_meter_reading/edit.html.twig', [
            'meterReadingForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/meter/reading/{id}/delete", name="admin_meter_reading_delete")
     */
    public function delete(MeterReadingRepository $meterReadingRepository, EntityManagerInterface $em, $id): Response
    {
        $meterReading=$meterReadingRepository->find($id);
        $meterReading->setIsDeleted(true);
        $em->persist($meterReading);
        $em->flush();
        $this->addFlash('success', 'Entry Removed!');
        return $this->redirectToRoute('admin_meter_reading_list');
    }

    /**
     * @Route("/admin/meter/reading", name="admin_meter_reading_list")
     */
    public function list(MeterReadingRepository $meterReadingRepository): Response
    {
        $meterReadings=$meterReadingRepository->findAllNonDeletedMeterReading();
        return $this->render('admin_meter_reading/list.html.twig',[
            'meterReadings'=>$meterReadings
        ]);
    }
}
