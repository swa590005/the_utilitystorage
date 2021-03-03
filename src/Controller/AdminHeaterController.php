<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\HeaterFormType;

class AdminHeaterController extends AbstractController
{
    /**
     * @Route("/admin/heater/new", name="admin_heater_new")
     */
    public function new()
    {
        $form = $this->createForm(HeaterFormType::class);
        return $this->render('admin_heater/new.html.twig', [
            'heaterForm' => $form->createView()
        ]);
    }

}
