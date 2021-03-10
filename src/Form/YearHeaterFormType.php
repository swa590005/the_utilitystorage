<?php


namespace App\Form;


use App\Entity\Heater;
use App\Repository\HeaterRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

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
            ->add('heater_number',EntityType::class,[
                'class'=>Heater::class,
                'choice_label'=> function(Heater $heater) {
                    return sprintf('%s (%s)', $heater->getHeaterNumber(), $heater->getRoom());
                },
                'choices' => $this->heaterRepository->findAllNonDeletedHeater(),
                'placeholder'=>'Choose a Heater',
            ])
            ->add('previous_year', DateType::class,[
                    'widget'=> 'choice',
                    'years' => range(2017,(new \DateTime('now -1 year'))->format('Y'),1)
            ])
            ->add('heater_reading',TextType::class);
    }
}