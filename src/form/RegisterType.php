<?php

namespace App\form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class RegisterType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, Array(
            'label'=>'Nombre'
        ))
        ->add('surname', TextType::class, Array(
            'label'=>'Apellido'
        ))
        ->add('email', EmailType::class, Array(
            'label'=>'Email'
        ))
        ->add('password', PasswordType::class, Array(
                        'label'=>'Password'
        ))
        ->add('submit', SubmitType::class, Array(
            'label'=>'Registrar'
        ));

        
    }
}