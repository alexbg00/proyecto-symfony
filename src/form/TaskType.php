<?php

namespace App\form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class TaskType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, Array(
            'label'=>'titulo'
        ))
        ->add('content', TextareaType::class, Array(
            'label'=>'Contenido'
        ))
        ->add('priority', ChoiceType::class, Array(
            'label'=>'Prioridad',
            'choices' => array(
                'Alta'=>'high',
                'Medio'=>'medium',
                'Baja' => 'low'
            )
        ))
        ->add('hours', TextType::class, Array(
                        'label'=>'Horas'
        ))
        ->add('submit', SubmitType::class, Array(
            'label'=>'CREAR'
        ));

        
    }
}