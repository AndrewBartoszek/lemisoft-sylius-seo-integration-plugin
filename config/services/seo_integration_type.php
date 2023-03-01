<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType\FacebookPixelSeoIntegrationType;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType\FacebookSeoIntegrationType;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType\GoogleAnalyticsSeoIntegrationType;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType\GoogleSiteVerificationSeoIntegrationType;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType\SeoIntegrationTypeInterface;
use Sylius\Component\Registry\ServiceRegistry;

return static function (ContainerConfigurator $containerConfigurator) {
    $services = $containerConfigurator->services();
    $services
        ->set('lemisoft.sylius_seo_integration_plugin.registry.seo-integration-type', ServiceRegistry::class)
        ->public()
        ->args([
            SeoIntegrationTypeInterface::class,
            'seo integration',
        ])
        ->call('register', ['facebook', service('lemisoft.sylius_seo_integration_plugin.type.facebook')])
        ->call('register', ['google_analytics', service('lemisoft.sylius_seo_integration_plugin.type.google_analytics')])
        ->call('register', ['facebook_pixel', service('lemisoft.sylius_seo_integration_plugin.type.facebook_pixel')])
        ->call('register', ['google_site_verification', service('lemisoft.sylius_seo_integration_plugin.type.google_site_verification')]);

    $services
        ->set('lemisoft.sylius_seo_integration_plugin.type.facebook', FacebookSeoIntegrationType::class);
    $services
        ->set('lemisoft.sylius_seo_integration_plugin.type.google_analytics', GoogleAnalyticsSeoIntegrationType::class);
    $services
        ->set('lemisoft.sylius_seo_integration_plugin.type.facebook_pixel', FacebookPixelSeoIntegrationType::class);
    $services
        ->set('lemisoft.sylius_seo_integration_plugin.type.google_site_verification', GoogleSiteVerificationSeoIntegrationType::class);
};
