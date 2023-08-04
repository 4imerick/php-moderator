<?php

namespace App\Form;

use App\Service\Moderator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostFormType extends AbstractType
{
    public function __construct(private Moderator $moderator)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // We use the addEventlistener method on PRE_SUBMIT to check the data of some fields, before submitting the data to the form.
            ->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'onPreSubmit'])
            ->add('commentary');
    }

    /**
     * Method that call the Moderator Service to check if the commentary of the post contains blacklisted words.  
     * @param FormEvent $formEvent
     * @return void
     */
    public function onPreSubmit(FormEvent $formEvent)
    {
        // We get the form. 
        $form = $formEvent->getForm();

        // We get the data of the post.
        $post = $formEvent->getData();

        // If the commentary of the post doesn't contains a blacklisted words we submit the form. 
        if (!$this->moderator->checkIfblacklistedWords($post['commentary'])) {
            $formEvent->setData($post);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
