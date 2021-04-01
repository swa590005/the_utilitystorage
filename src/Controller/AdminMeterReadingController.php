<?php

namespace App\Controller;

use App\Entity\MeterReading;
use App\Form\MeterReadingFormType;
use App\Repository\MeterReadingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class AdminMeterReadingController extends AbstractController
{
    /**
     * @Route("/meter/reading/new", name="app_meter_reading")
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

            return $this->redirectToRoute('app_meter_reading_list');

        }
        return $this->render('admin_meter_reading/new.html.twig', [
            'meterReadingForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/meter/reading/{id}/edit", name="app_meter_reading_edit")
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


            return $this->redirectToRoute('app_meter_reading_list');

        }
        return $this->render('admin_meter_reading/edit.html.twig', [
            'meterReadingForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/meter/reading/{id}/delete", name="app_meter_reading_delete")
     * @IsGranted ("ROLE_ADMIN")
     *
     */
    public function delete(MeterReadingRepository $meterReadingRepository, EntityManagerInterface $em, $id): Response
    {
        $meterReading=$meterReadingRepository->find($id);
        $meterReading->setIsDeleted(true);
        $em->persist($meterReading);
        $em->flush();
        $this->addFlash('success', 'Entry Removed!');
        return $this->redirectToRoute('app_meter_reading_list');
    }

    /**
     * @Route("/meter/reading", name="app_meter_reading_list")
     */
    public function list(MeterReadingRepository $meterReadingRepository): Response
    {
        $meterReadings=$meterReadingRepository->findAllNonDeletedMeterReading();
        return $this->render('admin_meter_reading/list.html.twig',[
            'meterReadings'=>$meterReadings
        ]);
    }
}
