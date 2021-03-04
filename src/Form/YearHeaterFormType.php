<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\WeekType;
use Symfony\Component\Form\FormBuilderInterface;

class YearHeaterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('room_name')
            ->add('heater_number')
            ->add('previous_year', DateType::class, [
                'widget'=> 'single_text',
            ])
            ->add('heater_reading')



        ;
    }
}