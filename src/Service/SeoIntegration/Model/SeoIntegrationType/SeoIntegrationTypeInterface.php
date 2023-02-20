<?php

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType;

interface SeoIntegrationTypeInterface
{
    public function getType(): string;

    public function getTemplate(): string;

    public function getConfigurationFormClass(): string;
}
