<?php

namespace App\Controller;



use App\Entity\YearHeaterReading;
use App\Form\YearHeaterFormType;
use App\Repository\YearHeaterReadingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @IsGranted ("ROLE_ADMIN")
 */
class AdminYearHeaterController extends AbstractController
{

    /**
     * @Route("/admin/year/heater/new", name="admin_year_heater")
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(YearHeaterFormType::class);

        //handle request comes into picture during post
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $yearHeaterReading=$form->getData();
            $em->persist($yearHeaterReading);
            $em->flush();
            $this->addFlash('success', 'Entry Created!');

            return $this->redirectToRoute('admin_year_heater_list');

        }

        return $this->render('admin_year_heater/new.html.twig', [
            'yearHeaterForm' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/year/heater/{id}/edit", name="admin_year_heater_edit")
     */
    public function edit(YearHeaterReading $yearHeaterReading, EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(YearHeaterFormType::class, $yearHeaterReading);

        //handle request comes into picture during post
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($yearHeaterReading);
            $em->flush();

            $this->addFlash('success', 'Entry Updated!');


            return $this->redirectToRoute('admin_year_heater_list');

        }
        return $this->render('admin_year_heater/edit.html.twig', [
            'yearHeaterForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/year/heater/{id}/delete", name="admin_year_heater_delete")
     */
    public function delete(YearHeaterReadingRepository $yearHeaterReadingRepository, EntityManagerInterface $em, $id): Response
    {
        $yearHeaterReading=$yearHeaterReadingRepository->find($id);
        $yearHeaterReading->setIsDeleted(true);
        $em->persist($yearHeaterReading);
        $em->flush();
        $this->addFlash('success', 'Entry Removed!');
        return $this->redirectToRoute('admin_year_heater_list');
    }

    /**
     * @Route("/admin/year/heater", name="admin_year_heater_list")
     */
    public function list(YearHeaterReadingRepository $yearHeaterReadingRepository): Response
    {
        $yearHeaterReadings=$yearHeaterReadingRepository->findAllNonDeletedYearHeater();
        return $this->render('admin_year_heater/list.html.twig',[
            'yearHeaterReadings'=>$yearHeaterReadings
        ]);
    }
}
