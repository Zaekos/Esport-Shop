<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Accessoire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccessoireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nom'
            ])
            ->add('price', NumberType::class, [
                'required' => true,
                'label' => 'Prix'
            ])
            ->add('description', TextType::class, [
                'required'=>true,
                'label' => 'Description'])
            // Je créé un nouveau champs de formulaire
            // ce champs est pour la propriété 'Equipe'
            // vu que ce champs contient une relation vers
            // une autre entité, le type choisi doit être
            // EntityType
            ->add('equipe', EntityType::class, [
                // je sélectionne l'entité à afficher, ici
                // Author car ma relation fait référence aux auteurs
                'class' => Equipe::class,
                // je choisi la propriété d'Equipe qui s'affiche
                // dans le select du html
                'choice_label' => 'libelle',
            ])
            ->add('show', CheckboxType::class, [
                'label' => 'Mis en avant',
                'required' => true
            ])
            ->add('created_at', DateType::class, [
                'years' => range(date('Y'), date('Y') - 500),
                'required'=>true,
                'label' => 'Crée à'])
            ->add('in_stock', CheckboxType::class, [
                'label' => 'Disponible',
                'required' => true
            ])
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Peripherique::class,
        ]);
    }
}
