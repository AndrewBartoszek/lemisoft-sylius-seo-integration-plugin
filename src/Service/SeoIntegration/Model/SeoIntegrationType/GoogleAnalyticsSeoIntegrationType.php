<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType;

use Lemisoft\SyliusSeoIntegrationPlugin\Form\SeoIntegrationType\SeoIntegrationConfigurationDefaultType;

class GoogleAnalyticsSeoIntegrationType implements SeoIntegrationTypeInterface
{
    public const TYPE = 'google_analytics';
    public const TEMPLATE = '@LemisoftSyliusSeoIntegrationPlugin/Shop/SeoIntegration/google_analytics.html.twig';
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
