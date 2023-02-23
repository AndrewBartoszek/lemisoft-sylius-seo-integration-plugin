<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\EventListener;

use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\SeoIntegrationService;

class SeoIntegrationListener
{
    public function __construct(protected SeoIntegrationService $seoIntegrationService)
    {
    }

    public function refreshSeoIntegrationCache(): void
    {
        $this->seoIntegrationService->deleteSeoCache();
        $this->seoIntegrationService->getAllIntegrations();
    }
}
