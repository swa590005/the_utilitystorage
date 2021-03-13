<?php


namespace App\Form;


use App\Entity\Heater;
use App\Entity\HeaterReading;
use App\Repository\HeaterRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HeaterReadingFormType extends AbstractType
{

    private $heaterRepository;
    public function __construct(HeaterRepository $heaterRepository)
    {
        $this->heaterRepository = $heaterRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('heater',EntityType::class,[
                'class'=>Heater::class,
                'choice_label'=> function(Heater $heater) {
                    return sprintf('%s (%s)', $heater->getHeaterNumber(), $heater->getRoom());
                },
                'choices' => $this->heaterRepository->findAllNonDeletedHeater(),
                'placeholder'=>'Choose a Heater',
            ])
            ->add('readingDate', DateType::class,[
                'widget'=> 'single_text'
            ])
            ->add('heater_reading',TextType::class);
        ;
        $builder->get('readingDate')->addModelTransformer(new CallbackTransformer(
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
            'data_class'=> HeaterReading::class
        ]);
    }
}