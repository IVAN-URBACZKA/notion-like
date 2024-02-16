<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Interaction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class InteractionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('typeInteraction', ChoiceType::class,[
                'choices'  => [
                    'Tel' => Interaction::TEL,
                    'Email' => Interaction::EMAIL,
                    'RS' => Interaction::RESEAUX_SOCIAUX
                ]])
            ->add('report')
            ->add('priority')
            ->add('statut')
            ->add('contact', EntityType::class, [
                'class' => Contact::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Interaction::class,
        ]);
    }
}
