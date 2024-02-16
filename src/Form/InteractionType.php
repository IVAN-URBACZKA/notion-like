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
            ->add('priority', ChoiceType::class,[
                'choices'  => [
                    'Important' => Interaction::HIGH,
                    'Moyen' => Interaction::MIDDLE,
                    'Basse' => Interaction::LOW
                ]])
            ->add('statut', ChoiceType::class,[
                'choices'  => [
                    'Terminé' => Interaction::COMPLETED,
                    'En cours' => Interaction::INPROGRESS,
                ]])
            ->add('contact', EntityType::class, [
                'class' => Contact::class,
'choice_label' => 'email',
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
