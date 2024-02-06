<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlength' => '2',
                'maxlength' => '50'
            ],
            'label' => 'Nom',
            'constraints' => [
                new Assert\Length(['min' => 2, 'max' => 50]),
            ],
        ])
            ->add('firstName', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Prénom',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                ],
            ])
            ->add('email', EmailType::class)
            ->add('tel', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '10', 
                    'maxlength' => '15'
                ],
                'label' => 'Numéro de téléphone',
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])
           
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
