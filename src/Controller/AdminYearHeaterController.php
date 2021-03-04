<?php

namespace App\Controller;


use App\Form\YearHeaterFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminYearHeaterController extends AbstractController
{

    /**
     * @Route("/admin/year/heater", name="admin_year_heater")
     */
    public function new(): Response
    {
        $form = $this->createForm(YearHeaterFormType::class);
        return $this->render('admin_year_heater/new.html.twig', [
            'yearHeaterForm' => $form->createView()
        ]);
    }
}
