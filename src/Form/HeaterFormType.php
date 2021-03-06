<?php

namespace App\Form;

use App\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class HeaterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('room_name',EntityType::class,[
                'class'=>Room::class,
                'choice_label'=> 'roomName',
                'placeholder'=>'Choose a Room',
            ])
            ->add('heater_number')
            ;
    }
    
}
