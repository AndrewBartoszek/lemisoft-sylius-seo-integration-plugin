<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType;

class FacebookSeoIntegrationType implements SeoIntegrationTypeInterface
{
    public const TYPE = 'facebook';
    public const TEMPLATE = '@LemisoftSyliusSeoIntegrationPlugin/Shop/SeoIntegration/facebook.html.twig';

    public function getType(): string
    {
        return self::TYPE;
    }

    public function getTemplate(): string
    {
        return self::TEMPLATE;
    }
}
