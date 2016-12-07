<?php

namespace saya25\LouvreBundle\Form;

use saya25\LouvreBundle\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class BilletType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status',         ChoiceType::class, array(
                'label' =>  'Billet',
                'choices'   => array(
                    'Journée'  =>  true,
                    'Demi-Journée'  => false,
                ),
            ))
            ->add('nom',            TextType::class)
            ->add('prenom',         TextType::class)
            ->add('pays',           CountryType::class)
            ->add('dateNaissance',  DateType::class)
            ->add('tarifReduit',    CheckboxType::class)
            ->add('prix',           NumberType::class)
            ->add('Ajouter',        SubmitType::class);



    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'saya25\LouvreBundle\Entity\Billet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'saya25_louvrebundle_billet';
    }


}
