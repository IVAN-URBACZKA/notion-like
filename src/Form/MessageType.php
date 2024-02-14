<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', TextType::class, [
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '50', 
                ],
                'label' => 'Sujet',
            ])
            ->add('text', TextType::class, [
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '100', 
                ],
                'label' => 'Message',
            ])
            ->add('email', EmailType::class);
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Pas besoin de configurer 'data_class' car nous n'utilisons pas d'entité
        ]);
    }
}
