<?php

namespace saya25\LouvreBundle\Form;

use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',                TextType::class)
            ->add('prenom',             TextType::class)
            ->add('dateCommande',       DateType::class)
            ->add('dateEntree',         DateType::class)
            ->add('pays',               CountryType::class)
            ->add('numeroReservation',  TextType::class)
            ->add('status',             ChoiceType::class)
            ->add('total',               NumberType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'saya25\LouvreBundle\Entity\Commande'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'saya25_louvrebundle_commande';
    }


}
