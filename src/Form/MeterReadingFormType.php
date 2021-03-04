<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;

class MeterReadingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('meter_number')
            ->add('reading_date', DateType::class, [
                'widget'=> 'single_text',
            ])
            ->add('meter_reading')
        ;
    }

}