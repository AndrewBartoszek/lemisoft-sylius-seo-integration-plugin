<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Factory;

use Lemisoft\SyliusSeoIntegrationPlugin\Entity\Seo\SeoIntegration;
use Lemisoft\SyliusSeoIntegrationPlugin\Entity\Seo\SeoIntegrationInterface;
use Sylius\Component\Registry\ServiceRegistryInterface;

class SeoIntegrationFactory implements SeoIntegrationFactoryInterface
{
    /**
     * @psalm-var class-string
     *
     * @psalm-suppress MissingTemplateParam
     */
    private string $className;

    /**
     * @psalm-param class-string $className
     */
    public function __construct(string $className, protected ServiceRegistryInterface $attributeTypesRegistry)
    {
        $this->className = $className;
    }

    /**
     * @psalm-suppress MixedMethodCall
     */
    public function createNew()
    {
        return new $this->className();
    }

    public function createTyped(string $type): SeoIntegrationInterface
    {
        $this->attributeTypesRegistry->get($type);

        /** @var SeoIntegration $entity */
        $entity = $this->createNew();
        $entity->setType($type);

        return $entity;
    }
}
