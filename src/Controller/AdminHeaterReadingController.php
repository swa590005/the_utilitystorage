<?php

namespace App\Controller;

use App\Form\HeaterReadingFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminHeaterReadingController extends AbstractController
{
    /**
     * @Route("/admin/heater/reading", name="admin_heater_reading")
     */
    public function new(): Response
    {
        $form = $this->createForm(HeaterReadingFormType::class);
        return $this->render('admin_heater_reading/new.html.twig', [
            'heaterReadingForm' => $form->createView()
        ]);
    }
}
