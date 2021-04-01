<?php

namespace App\Controller;

use App\Entity\HeaterReading;
use App\Form\HeaterReadingFormType;
use App\Repository\HeaterReadingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted ("ROLE_USER")
 */

class AdminHeaterReadingController extends AbstractController
{
    /**
     * @Route("/heater/reading/new", name="app_heater_reading")
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(HeaterReadingFormType::class);

        //handle request comes into picture during post
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $heaterReading=$form->getData();
            $em->persist($heaterReading);
            $em->flush();
            $this->addFlash('success', 'Entry Created!');

            return $this->redirectToRoute('app_heater_reading_list');

        }
        return $this->render('admin_heater_reading/new.html.twig', [
            'heaterReadingForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/heater/reading/{id}/edit", name="app_heater_reading_edit")
     */
    public function edit(HeaterReading $heaterReading, EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(HeaterReadingFormType::class, $heaterReading);

        //handle request comes into picture during post
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($heaterReading);
            $em->flush();

            $this->addFlash('success', 'Entry Updated!');


            return $this->redirectToRoute('app_heater_reading_list');

        }
        return $this->render('admin_heater_reading/edit.html.twig', [
            'heaterReadingForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/heater/reading/{id}/delete", name="app_heater_reading_delete")
     * @IsGranted ("ROLE_ADMIN")
     */
    public function delete(HeaterReadingRepository $heaterReadingRepository, EntityManagerInterface $em, $id): Response
    {
        $heaterReading=$heaterReadingRepository->find($id);
        $heaterReading->setIsDeleted(true);
        $em->persist($heaterReading);
        $em->flush();
        $this->addFlash('success', 'Entry Removed!');
        return $this->redirectToRoute('app_heater_reading_list');
    }

    /**
     * @Route("/heater/reading", name="app_heater_reading_list")
     */
    public function list(HeaterReadingRepository $heaterReadingRepository): Response
    {
        $heaterReadings=$heaterReadingRepository->findAllNonDeletedHeaterReading();
        return $this->render('admin_heater_reading/list.html.twig',[
            'heaterReadings'=>$heaterReadings
        ]);
    }
}
