<?php

namespace App\Controller;

use App\Form\MeterReadingFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMeterReadingController extends AbstractController
{
    /**
     * @Route("/admin/meter/reading", name="admin_meter_reading")
     */
    public function new(): Response
    {
        $form = $this->createForm(MeterReadingFormType::class);
        return $this->render('admin_meter_reading/new.html.twig', [
            'meterReadingForm' => $form->createView()
        ]);
    }
}
