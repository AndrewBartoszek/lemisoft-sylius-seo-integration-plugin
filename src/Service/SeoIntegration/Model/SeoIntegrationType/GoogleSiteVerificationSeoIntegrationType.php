<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType;

use Lemisoft\SyliusSeoIntegrationPlugin\Form\SeoIntegrationType\SeoIntegrationBeforeBodyConfigurationDefaultType;

class GoogleSiteVerificationSeoIntegrationType implements SeoIntegrationTypeInterface
{
    public const TYPE = 'google_site_verification';
    public const TEMPLATE = '@LemisoftSyliusSeoIntegrationPlugin/Shop/SeoIntegration/google_site_verification.html.twig';
    public const CONFIGURATION_FORM_CLASS = SeoIntegrationBeforeBodyConfigurationDefaultType::class;

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
