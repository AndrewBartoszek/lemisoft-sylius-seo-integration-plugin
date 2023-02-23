<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Form\SeoIntegrationType;

use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationRenderType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

class SeoIntegrationAfterBodyConfigurationDefaultType extends AbstractType
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
            ->addEventListener(FormEvents::PRE_SUBMIT, static function (FormEvent $event): void {
                /** @var array $data */
                $data = $event->getData();
                $data['place'] = SeoIntegrationRenderType::BODY_AFTER_BODY;

                $event->setData($data);
            });
    }

    public function getBlockPrefix(): string
    {
        return 'lemisoft_sylius_seo_integration_plugin_seo_integration_after_body_configuration_default_form';
    }
}
