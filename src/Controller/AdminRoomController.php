<?php

namespace App\Controller;

use App\Entity\Room;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RoomFormType;

/**
 * @IsGranted ("ROLE_ADMIN")
 */

class AdminRoomController extends AbstractController
{
    
    /**
     * @Route("/admin/room/new", name="admin_room_new")
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(RoomFormType::class);

        //handle request comes into picture during post
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $room=$form->getData();
            $em->persist($room);
            $em->flush();
            $this->addFlash('success', 'Room Created!');

            return $this->redirectToRoute('admin_room_list');

        }
        return $this->render('admin_room/new.html.twig', [
            'roomForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/room/{id}/edit", name="admin_room_edit")
     */
    public function edit(Room $room, EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(RoomFormType::class, $room);

        //handle request comes into picture during post
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($room);
            $em->flush();

            $this->addFlash('success', 'Room Updated!');


            return $this->redirectToRoute('admin_room_list');

        }
        return $this->render('admin_room/edit.html.twig', [
            'roomForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/room/{id}/delete", name="admin_room_delete")
     */
    public function delete(RoomRepository $roomRepository, EntityManagerInterface $em, $id)
    {
        $room=$roomRepository->find($id);
        $room->setIsDeleted(true);
        $em->persist($room);
        $em->flush();

        return $this->redirectToRoute('admin_room_list');
    }

    /**
     * @Route("/admin/room", name="admin_room_list")
     */
    public function list(RoomRepository $roomRepository): Response
    {
        $rooms=$roomRepository->findAllNonDeletedRoom();
        return $this->render('admin_room/list.html.twig',[
            'rooms'=>$rooms,
        ]);
    }
}
