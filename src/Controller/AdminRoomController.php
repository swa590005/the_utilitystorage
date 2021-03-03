<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RoomFormType;

class AdminRoomController extends AbstractController
{
    
    /**
     * @Route("/admin/room/new", name="admin_room_new")
     */
    public function new()
    {
        $form = $this->createForm(RoomFormType::class);
        return $this->render('admin_room/new.html.twig', [
            'roomForm' => $form->createView()
        ]);
    }
}
