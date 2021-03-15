<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index()
    {
        return $this->render('home/homepage.html.twig', []);
    }
    /**
     * @Route("/eletricDetails", name="electric_list")
     */
    public function showElectricList(): Response
    {
            
            return $this->render('home/show_meter_readinglist.html.twig',[]);
    }
    /**
     * @Route("/heaterDetails", name="heater_list")
     */
    public function showHeaterList(): Response
    {
            
            return $this->render('home/show_heizung_readinglist.html.twig',[]);
    }
}
