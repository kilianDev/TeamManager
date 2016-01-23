<?php

namespace Teammanager\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;


class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name','text', array(
            'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('max' => 254)))
        ))
            ->add('description','textarea', array(
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('max' => 254)))
            ));
    }

    public function getName()
    {
        return 'Teammate';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Teammanager\Model\Team',
        ));
    }
}