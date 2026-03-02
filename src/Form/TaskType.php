<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'attr' => ['placeholder' => 'Que dois-je faire ?'],
                'constraints' => [
                    new NotBlank(['message' => 'Le titre est obligatoire !']),
                    new Length(['min' => 3, 'max' => 255]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['rows' => 3, 'placeholder' => 'Détails optionnels...'],
                'required' => false,
            ])
            ->add('dueDate', DateTimeType::class, [
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'required' => false,
                'html5' => true,
                'attr' => ['step' => 1],
            ])
            ->add('isDone', null, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
