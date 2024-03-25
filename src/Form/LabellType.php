<?php

namespace App\Form;

use App\Entity\Labell;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;


class LabellType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'label' => "Nom du label",
            'attr' => [
                "placeholder" => "saisir le nom du label"
            ]
        ]) // Type de champ html
            ->add('description', TextareaType::class)
            ->add('anneeCreation')
            ->add('type', ChoiceType::class, [
                "choices" => [
                    "Independant" => 0,
                    "groupe" => 1
                ]
            ])
            ->add('logo', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Labell::class,
        ]);
    }
}
