<?php

namespace App\Form;

use App\Entity\Chantier;
use App\Entity\Pointage;
use App\Entity\Utilisateur;
use App\Validator\ErrorHandler;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Range;

class PointageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => function (Utilisateur $utilisateur) {
                    return $utilisateur->getNomComplet();
                },
            ])
            ->add('chantier', EntityType::class, [
                'placeholder'=> 'Sélectionnez un chantier...',
                'class' => Chantier::class,
                'choice_label' => 'nom',
            ])
            ->add('date', DateType::class, [
                'placeholder'=> 'Entrez une date de pointage...',
                'widget' => 'single_text',
                'html5'=> false,
                'format'=> 'dd/MM/yyyy',
                'label' => 'Date du pointage (jj/mm/aaaa)',
                'data' => new \DateTime()
            ])
            ->add('duree', NumberType::class, [
                'data'=> 0
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pointage::class,
            /*'constraints' => [
                new Callback([FormErrorHandler::class, 'validate']),
            ],*/
        ]);
    }

}