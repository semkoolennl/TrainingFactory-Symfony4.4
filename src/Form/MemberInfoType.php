<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class MemberInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('postal_code', TextType::class)
            ->add('street', TextType::class)
            ->add('housenumber', TextType::class)
            ->add('place', TextType::class)
            ->add('save', SubmitType::class)
        ;
    }
}
