<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productName', TextType::class)
            ->add('productDescription', TextType::class)
            ->add('disponibility', CheckboxType::class)
            ->add('unitaryPrice', MoneyType::class, array(
                'scale'=>2,
                'currency' => 'Eur',
            ))
            ->add('picture', FileType::class,array('label' => 'Picture'))
            ->add('Category', EntityType::class, array(
                'class'=>'AppBundle\Entity\Category',
                'choice_label'=> 'categoryName',
                'expanded'=>false,
                'multiple'=>false,
            ))
            ->add('save', SubmitType::class, array('label' => 'Add a Product'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Product'
        ));
    }
}

