<?php

namespace saya25\LouvreBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
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
            ->add('dateEntree',     DateType::class, array(
                'label' => 'Date de la visite',
                'html5' => false,
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
            ))
            ->add('nom',                TextType::class)
            ->add('prenom',             TextType::class)
            ->add('email',              EmailType::class);
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
