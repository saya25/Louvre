<?php

namespace saya25\LouvreBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

//validators

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;


class CommandeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateEntree', DateType::class, array(
                'label' => 'Date de la visite',
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
            ))
            ->add('nom', TextType::class, array(
                'label'  => 'Nom',
                'constraints' => array(
                    new NotBlank(),
                    new Type('string'),
                    new Length(array(
                        'min'   => 4,
                        'minMessage' => 'Le nom saisi est trop court !',
                        'max'   =>40,
                        'maxMessage' => 'Le nom saisi est trop long!',
                    )),
                ),
            ))
            ->add('prenom', TextType::class, array(
                'label'  => 'Prénom',
                'constraints' => array(
                    new NotBlank(),
                    new Type('string'),
                    new Length(array(
                        'min'   => 3,
                        'minMessage' => 'Le prénom saisi est trop court !',
                        'max'   =>30,
                        'maxMessage' => 'Le prénom saisi est trop long!',
                    )),
                ),
            ))
            ->add('email', EmailType::class);
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
