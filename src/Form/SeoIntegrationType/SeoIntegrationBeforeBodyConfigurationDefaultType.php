<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Form\SeoIntegrationType;

use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationRenderType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Sylius\Component\Core\Model\CustomerInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class SeoIntegrationBeforeBodyConfigurationDefaultType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, [
                'label'       => '',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('place', HiddenType::class, [
                'label'       => false,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event): void {
                $data = $event->getData();
                $data['place'] = SeoIntegrationRenderType::BODY_BEFORE_BODY;

                $event->setData($data);
            });
    }

    public function getBlockPrefix(): string
    {
        return 'lemisoft_sylius_seo_integration_plugin_seo_integration_before_body_configuration_default_form';
    }
}
