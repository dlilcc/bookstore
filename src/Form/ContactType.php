<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

    class ContactType extends AbstractType{
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
            ->add('name')
            ->add('feedback')
            ->add('save', SubmitType::class,[
                'label' => 'Confirm'
            ])
            ;
        }
    }
?>