<?php

namespace saya25\LouvreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


//Validators

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;


class BilletType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', ChoiceType::class, array(
                'label_format'  => '%name%',
                'choices'   => array(
                    'Journée'  =>  true,
                    'Demi-Journée'  => false,
                ),
            ))
            ->add('nom', TextType::class, array(
                'label_format'  => '%name%',
                'constraints'   => array(
                    new NotBlank(),
                    new Type('string'),
                    new Length(array(
                        'min'   => 3,
                        'minMessage' => 'Le nom saisi est trop court !',
                        'max'   =>40,
                        'maxMessage' => 'Le nom saisi est trop long!',
                    )),
                ),
            ))
            ->add('prenom', TextType::class, array(
                'label_format'  => '%name%',
                'constraints'   => array(
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
            ->add('pays',           CountryType::class, array(
                'label_format'  => '%name%',
            ))
            ->add('dateNaissance',  BirthdayType::class, array(
                'label_format'  => '%name%',
            ))
            ->add('tarifReduit',    CheckboxType::class, array(
                'label_format'  => '%name%',
                    'required'  => false,
            ))
            ->add('Ajouter',        SubmitType::class, array(
                'label_format'  => '%name%',
            ));
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





