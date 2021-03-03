<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\MeterFormType;

class AdminMeterController extends AbstractController
{
    
    /**
     * @Route("/admin/meter/new", name="admin_meter_new")
     */
    public function new()
    {
        $form = $this->createForm(MeterFormType::class);
        return $this->render('admin_meter/new.html.twig', [
            'meterForm' => $form->createView()
        ]);
    }
} 
