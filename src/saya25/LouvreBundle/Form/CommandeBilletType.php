<?php

namespace saya25\LouvreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeBilletType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('billet', CollectionType::class, array(
                'entry_type'   => BilletType::class,
                'label' => false,
                'allow_add'    => true,
                'allow_delete'  => true,
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class"=>'saya25\LouvreBundle\Entity\Commande'
        ]);
    }

    public function getName()
    {
        return 'saya25louvre_bundle_commande_billet_type';
    }
}
