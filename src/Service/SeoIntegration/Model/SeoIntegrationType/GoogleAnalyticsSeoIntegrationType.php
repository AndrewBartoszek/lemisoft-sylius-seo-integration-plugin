<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType;

class GoogleAnalyticsSeoIntegrationType implements SeoIntegrationTypeInterface
{
    public const TYPE = 'google_analytics';
    public const TEMPLATE = '@LemisoftSyliusSeoIntegrationPlugin/Shop/SeoIntegration/google_analytics.html.twig';

    public function getType(): string
    {
        return self::TYPE;
    }

    public function getTemplate(): string
    {
        return self::TEMPLATE;
    }
}
