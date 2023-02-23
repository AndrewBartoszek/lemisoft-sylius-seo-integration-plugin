<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Form;

use Exception;
use Lemisoft\SyliusSeoIntegrationPlugin\Entity\Seo\SeoIntegrationInterface;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\SeoIntegrationService;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Valid;

class SeoIntegrationType extends AbstractResourceType
{
    /**
     * @param string[] $validationGroups
     */
    public function __construct(
        public SeoIntegrationService $seoIntegrationService,
        public string $dataClass,
        public array $validationGroups = [],
    ) {
        parent::__construct($dataClass, $validationGroups);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var SeoIntegrationInterface $entity */
        $entity = $options['data'];

        $seoIntegrationTypeString = $entity->getType() ?? throw new Exception('Nie mozna utworzyc integracji bez typu');

        $seoIntegrationType = $this->seoIntegrationService->findRegisterType($seoIntegrationTypeString);
        if (null === $seoIntegrationType) {
            throw new Exception(sprintf('Nie zarejestrowano typu %s', $seoIntegrationTypeString));
        }

        $builder
            ->add('name', TextType::class, [
                'label' => '',
            ])
            ->add('type', HiddenType::class, [
                'label' => false,
                'data'  => $entity->getType(),
            ])->addEventListener(
                FormEvents::PRE_SET_DATA,
                static function (FormEvent $event) use ($seoIntegrationType): void {
                    $form = $event->getForm();
                    $form->add('configuration', CollectionType::class, [
                        'entry_type' => $seoIntegrationType->getConfigurationFormClass(),
                        'label' => false,
                        'allow_add' => false,
                        'allow_delete' => false,
                        'constraints' => [
                            new Valid(),
                        ],
                    ]);

                    /** @var SeoIntegrationInterface $data */
                    $data = $event->getData();
                    if ([] === $data->getConfiguration()) {
                        $data->setConfiguration([0 => []]);
                    }
                    $event->setData($data);
                },
            )->addEventListener(FormEvents::PRE_SUBMIT, static function (FormEvent $event): void {
                /** @var array $data */
                $data = $event->getData();
                $form = $event->getForm();
                /** @var SeoIntegrationInterface $entity */
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
