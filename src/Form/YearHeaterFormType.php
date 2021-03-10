<?php


namespace App\Form;


use App\Entity\Heater;
use App\Entity\YearHeaterReading;
use App\Repository\HeaterRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class YearHeaterFormType extends AbstractType
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
                    'widget'=> 'choice',
                    'years' => range(2017,(new \DateTime('now -1 year'))->format('Y'),1)
            ])
            ->add('heater_reading',TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //This binds the form to that class.
        $resolver->setDefaults([
            'data_class'=> YearHeaterReading::class
        ]);
    }
}