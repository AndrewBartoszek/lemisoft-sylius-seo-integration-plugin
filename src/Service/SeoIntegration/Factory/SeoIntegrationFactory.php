<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Factory;

use Lemisoft\SyliusSeoIntegrationPlugin\Entity\Seo\SeoIntegration;
use Lemisoft\SyliusSeoIntegrationPlugin\Entity\Seo\SeoIntegrationInterface;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType\SeoIntegrationTypeInterface;
use Sylius\Component\Attribute\AttributeType\AttributeTypeInterface;
use Sylius\Component\Attribute\Model\AttributeInterface;
use Sylius\Component\Registry\ServiceRegistryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class SeoIntegrationFactory implements SeoIntegrationFactoryInterface
{
    /**
     * @var string
     *
     * @psalm-var class-string
     */
    private $className;

    public ServiceRegistryInterface $attributeTypesRegistry;

    /**
     * @psalm-param class-string $className
     */
    public function __construct(string $className, $attributeTypesRegistry)
    {
        $this->className = $className;
        $this->attributeTypesRegistry = $attributeTypesRegistry;
    }

    public function createNew()
    {
        return new $this->className();
    }

    public function createTyped(string $type): SeoIntegrationInterface
    {
        /** @var SeoIntegrationTypeInterface $seoIntegrationType */
        $seoIntegrationType = $this->attributeTypesRegistry->get($type);

        /** @var SeoIntegration $entity */
        $entity = $this->createNew();
        $entity->setType($type);

        return $entity;
    }
}
