<?php

declare(strict_types=1);

namespace App\Product\Form;

use App\Product\DTO\ProductCreateDTO;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductCreateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', Type\TextType::class, [
                'label' => 'Product Name',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('price', Type\IntegerType::class, [
                'label' => 'Product Price',
                'attr' => [
                    'class' => 'form-control'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array(
            'data_class' => ProductCreateDTO::class,
        ));
    }
}
