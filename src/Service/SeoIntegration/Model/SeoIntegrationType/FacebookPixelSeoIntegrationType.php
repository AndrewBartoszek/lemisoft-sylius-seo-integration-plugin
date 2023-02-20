<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType;

use Lemisoft\SyliusSeoIntegrationPlugin\Form\SeoIntegrationType\SeoIntegrationConfigurationDefaultType;

class FacebookPixelSeoIntegrationType implements SeoIntegrationTypeInterface
{
    public const TYPE = 'facebook_pixel';
    public const TEMPLATE = '@LemisoftSyliusSeoIntegrationPlugin/Shop/SeoIntegration/facebook_pixel.html.twig';
    public const CONFIGURATION_FORM_CLASS = SeoIntegrationConfigurationDefaultType::class;

    public function getType(): string
    {
        return self::TYPE;
    }

    public function getTemplate(): string
    {
        return self::TEMPLATE;
    }

    public function getConfigurationFormClass(): string
    {
        return self::CONFIGURATION_FORM_CLASS;
    }
}
