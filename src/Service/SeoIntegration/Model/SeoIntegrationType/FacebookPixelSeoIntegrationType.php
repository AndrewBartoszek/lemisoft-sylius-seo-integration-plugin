<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType;

class FacebookPixelSeoIntegrationType implements SeoIntegrationTypeInterface
{
    public const TYPE = 'facebook_pixel';
    public const TEMPLATE = '@LemisoftSyliusSeoIntegrationPlugin/Shop/SeoIntegration/facebook_pixel.html.twig';

    public function getType(): string
    {
        return self::TYPE;
    }

    public function getTemplate(): string
    {
        return self::TEMPLATE;
    }
}
