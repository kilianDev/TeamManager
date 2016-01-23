<?php

namespace Teammanager\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;


class TeammateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname','text', array(
            'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('max' => 254)))
        ))
            ->add('lastname','text', array(
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('max' => 254)))
            ))
            ->add('email','text', array(
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('max' => 254)))
            ))
            ->add('phone','text', array(
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('max' => 20)))
            ));
    }

    public function getName()
    {
        return 'Teammate';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Teammanager\Model\Teammate',
        ));
    }
}