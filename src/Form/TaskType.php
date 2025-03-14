<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter task title'
                ],
                'label' => 'Title'
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 4,
                    'placeholder' => 'Enter task description'
                ],
                'label' => 'Description',
                'required' => false,
            ])
            ->add('priority', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 0,
                    'max' => 10
                ],
                'label' => 'Priority (0-10)',
                'help' => 'Higher number = higher priority'
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'To Do' => 'todo',
                    'In Progress' => 'in_progress',
                    'Review' => 'review',
                    'Done' => 'done',
                ],
                'attr' => ['class' => 'form-select'],
                'label' => 'Status'
            ])
            ->add('dueDate', DateTimeType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Due Date',
                'required' => false,
                'input' => 'datetime_immutable'
            ])
            ->add('assignedTo', EntityType::class, [
                'class' => User::class,
                'choices' => $options['users'] ?? [],
                'choice_label' => function (User $user) {
                    return $user->getFullName();
                },
                'attr' => ['class' => 'form-select'],
                'label' => 'Assigned To',
                'required' => false,
                'placeholder' => 'Select a user to assign'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
            'users' => [],
        ]);
    }
} 