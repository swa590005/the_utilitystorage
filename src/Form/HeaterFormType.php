<?php

namespace App\Form;

use App\Entity\Heater;
use App\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HeaterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // room is the property name in heater entity, choice label should be of type room class
        $builder
            ->add('room',EntityType::class,[
                'class'=>Room::class,
                'choice_label'=> function(Room $room) {
                    return sprintf('(%d) %s', $room->getId(), $room->getRoomName());
                },
                'placeholder'=>'Choose a Room',
            ])
            ->add('heater_number')
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //This binds the form to that class.
        $resolver->setDefaults([
            'data_class'=> Heater::class
        ]);
    }


    
}
