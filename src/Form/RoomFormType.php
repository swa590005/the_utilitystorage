<?php

namespace App\Form;

use App\Entity\Room;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('room_name',TextType::class,[
                'help'=> 'Enter Room'
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        //This binds the form to that class.
        $resolver->setDefaults([
            'data_class'=> Room::class
        ]);
    }
}
