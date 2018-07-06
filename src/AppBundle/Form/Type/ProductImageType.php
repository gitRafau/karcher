<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\Type\ProductImageType;

class ProductImageType extends AbstractType {

    /**
     * Build the form
     * @param None
     * @return void
     * */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('gallery', FileType::class, array(
          
            'multiple' => true
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(
                array(
                    'data_class' => 'AppBundle\Entity\ProductImages',
                )
        );
    }

    public function getName() {
        return 'ProductImageType';
    }

}
