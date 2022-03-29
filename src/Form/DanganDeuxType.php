<?php

namespace App\Form;

use App\Entity\DanganDeux;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DanganDeuxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Eleve', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('classe', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('talent', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('mail', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('photo', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-success mt-3']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DanganDeux::class,
        ]);
    }
}
