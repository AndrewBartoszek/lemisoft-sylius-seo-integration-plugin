<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Form;

use Lemisoft\SyliusSeoIntegrationPlugin\Entity\Seo\SeoIntegrationInterface;
use Lemisoft\SyliusSeoIntegrationPlugin\Form\SeoIntegrationType\SeoIntegrationConfigurationDefaultType;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType\SeoIntegrationTypeInterface;
use Sylius\Component\Core\Model\CustomerInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class SeoIntegrationType extends AbstractResourceType
{
    public string $dataClass;
    public array $validationGroups;

    public function __construct(string $dataClass, array $validationGroups = [])
    {
        parent::__construct($dataClass, $validationGroups);
        $this->dataClass = $dataClass;
        $this->validationGroups = $validationGroups;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var SeoIntegrationInterface $entity */
        $entity = $options['data'];

        $builder
            ->add('name', TextType::class, [
                'label' => '',
            ])
            ->add('type', HiddenType::class, [
                'label' => false,
                'data'  => $entity->getType(),
            ])
            ->add('configuration', CollectionType::class, [
                'entry_type'   => SeoIntegrationConfigurationDefaultType::class,
                'label'        => false,
                'allow_add'    => false,
                'allow_delete' => false,
                'constraints'  => [
                    new Valid(),
                ],
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
                $data = $event->getData();
                if (empty($data->getConfiguration())) {
                    $data->setConfiguration([0 => []]);
                }

                $event->setData($data);
            })
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event): void {
                $data = $event->getData();
                $form = $event->getForm();
                /** @var SeoIntegrationTypeInterface $entity */
                $entity = $form->getData();

                $data['type'] = $entity->getType();

                $event->setData($data);
            });
    }

    public function getBlockPrefix(): string
    {
        return 'lemisoft_sylius_seo_integration_plugin_seo_integration_form';
    }
}
