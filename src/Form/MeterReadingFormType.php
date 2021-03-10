<?php


namespace App\Form;


use App\Entity\Meter;
use App\Entity\MeterReading;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeterReadingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('meter',EntityType::class,[
                'class'=>Meter::class,
                'choice_label'=> function(Meter $meter) {
                    return sprintf('(%d) %s', $meter->getId(), $meter->getMeterNumber());
                },
                'placeholder'=>'Choose a Meter',
            ])
            ->add('reading_date', DateType::class, [
                'widget'=> 'single_text',
            ])
            ->add('meter_reading')
        ;
        $builder->get('reading_date')->addModelTransformer(new CallbackTransformer(
            function ($value) {
                if(!$value) {
                    return new \DateTime('now');
                }
                return $value;
            },
            function ($value) {
                return $value;
            }
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //This binds the form to that class.
        $resolver->setDefaults([
            'data_class'=> MeterReading::class
        ]);
    }

}