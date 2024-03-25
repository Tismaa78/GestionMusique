<?php

namespace App\Form;

use App\Entity\Artiste;
use App\Entity\Nationalite; // Import de la classe Nationalite
use Symfony\Bridge\Doctrine\Form\Type\EntityType; // Import de la classe EntityType
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class ArtisteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => "Nom de l'artiste",
                'attr' => [
                    "placeholder" => "Saisir le nom de l'artiste"
                ]
            ])
            ->add('description', TextareaType::class)
            ->add('site', UrlType::class)
            ->add('image', TextType::class)
            // Ajoutez le champ pour la nationalité
            ->add('nationalite', EntityType::class, [
                'class' => Nationalite::class, // Spécifiez la classe de l'entité Nationalite
                'choice_label' => 'libelle', // Utilisez la propriété libelle comme label pour les options
                'label' => 'Nationalité', // Label du champ dans le formulaire
                'placeholder' => 'Sélectionnez une nationalité', // Texte à afficher par défaut
                // Vous pouvez également ajouter d'autres options comme required, multiple, etc.
            ])
            ->add('type', ChoiceType::class, [
                "choices" => [
                    "Solo" => 0,
                    "Groupe" => 1
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artiste::class,
        ]);
    }
}
