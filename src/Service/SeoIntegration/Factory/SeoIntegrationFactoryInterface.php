<?php

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Factory;

use Lemisoft\SyliusSeoIntegrationPlugin\Entity\Seo\SeoIntegrationInterface;
use Sylius\Component\Attribute\Model\AttributeInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

interface SeoIntegrationFactoryInterface extends FactoryInterface
{
    public function createTyped(string $type): SeoIntegrationInterface;
}
