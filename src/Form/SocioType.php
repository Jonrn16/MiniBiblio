<?php

namespace App\Form;

use App\Entity\Socio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class SocioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dni', TextType::class, [
                'label' => 'DNI',
            ])
            ->add('nombre', TextType::class, [
                'label' => 'Nombre'
            ])
            ->add('apellidos', TextType::class, [
                'label' => 'Apellidos'
            ])
            ->add('docente', CheckboxType::class, [
                'label' => '¿Es docente?',
                'required' => false,
            ])
            ->add('estudiante', CheckboxType::class, [
                'label' => '¿Es estudiante?',
                'required' => false,
            ])
            ->add('telefono', TextType::class, [
                'label' => 'Teléfono',
                'required' => false,
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^[0-9 ]+$/',
                        'message' => 'El teléfono solo puede contener números y espacios.'
                    ]),
                    new Assert\Length([
                        'min' => 9,
                        'max' => 9,
                        'exactMessage' => 'El teléfono debe tener exactamente {{ limit }} cifras.'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Socio::class,
        ]);
    }
}