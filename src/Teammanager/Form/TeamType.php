<?php

namespace Teammanager\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class TeamType
 * @package Teammanager\Form
 */
class TeamType extends AbstractType
{
    /**
     * @var array
     */
    private $teammatesChoices;

    /**
     * @var array
     */
    private $teammatesSelected;

    /**
     * @param $teammatesChoices
     * @param null $teammatesSelected
     */
    public function __construct($teammatesChoices, $teammatesSelected = null)
    {
        $this->teammatesChoices = $teammatesChoices;
        $this->teammatesSelected = $teammatesSelected;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name','text', array(
            'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('max' => 255))),
            'required' => true
        ))
            ->add('description','textarea', array(
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('max' => 255))),
                'required' => false
            ))
            ->add('teammates', 'choice', array(
                'choices' => $this->teammatesChoices,
                'multiple' => true,
                'expanded' => false,
                'data' => $this->teammatesSelected,
                'required' => false
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Team';
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Teammanager\Model\Team',
        ));
    }
}