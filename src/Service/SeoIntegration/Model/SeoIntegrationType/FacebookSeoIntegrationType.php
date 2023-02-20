<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType;

use Lemisoft\SyliusSeoIntegrationPlugin\Form\SeoIntegrationType\SeoIntegrationConfigurationDefaultType;

class FacebookSeoIntegrationType implements SeoIntegrationTypeInterface
{
    public const TYPE = 'facebook';
    public const TEMPLATE = '@LemisoftSyliusSeoIntegrationPlugin/Shop/SeoIntegration/facebook.html.twig';
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
