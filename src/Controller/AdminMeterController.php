<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMeterController extends AbstractController
{
    /**
     * @Route("/admin/meter", name="admin_meter")
     */
    public function index(): Response
    {
        return $this->render('admin_meter/index.html.twig', []);
    }
}
