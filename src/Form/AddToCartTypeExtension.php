<?php

namespace App\Form;

use Ibexa\Bundle\Storefront\Form\Type\AddToCartType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class AddToCartTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('img_caption', TextType::class, [
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'maxlength' => 25,
                ],
            ])
            ->add('color', ColorType::class, [
                'required' => false,
                'mapped' => false,
                'data' => '#FFFFFF',
            ])
            ->add('shape', ChoiceType::class, [
                'required' => false,
                'mapped' => false,
                'choices' => [
                    'squared' => 0,
                    'rounded' => 1,
                ],
            ])
            ->add('img_border', CheckboxType::class, [
                'required' => false,
                'mapped' => false,
            ]);
    }

    public static function getExtendedTypes(): iterable
    {
        return [AddToCartType::class];
    }
}
