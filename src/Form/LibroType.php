<?php
// src/Form/LibroType.php

use App\Entity\Editorial;
use App\Entity\Autor;
use App\Entity\Socio;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class LibroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo')
            ->add('isbn')
            ->add('precio', MoneyType::class, [
                'divisor' => 100, // Según el enunciado (céntimos en BD)
                'currency' => 'EUR',
            ])
            ->add('editorial', EntityType::class, [
                'class' => Editorial::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.nombre', 'ASC'); // Orden alfabético
                },
            ])
            ->add('autores', EntityType::class, [
                'class' => Autor::class,
                'multiple' => true,
                'expanded' => false, // Lista múltiple
                'choice_label' => function (Autor $autor) {
                    return sprintf('%s %s', $autor->getNombre(), $autor->getApellidos());
                },
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->orderBy('a.nombre', 'ASC');
                },
            ])
            ->add('socio', EntityType::class, [
                'class' => Socio::class,
                'required' => false,
                'placeholder' => 'No prestado', // Si no hay socio seleccionado
                'choice_label' => function (Socio $socio) {
                    $texto = sprintf('%s, %s', $socio->getApellidos(), $socio->getNombre());
                    if ($socio->isDocente()) { // Suponiendo que existe isDocente()
                        $texto .= ' (docente)';
                    }
                    return $texto;
                },
            ]);
    }
}