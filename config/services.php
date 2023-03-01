<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\SeoIntegrationCacheService;

return static function (ContainerConfigurator $containerConfigurator) {
    $containerConfigurator->parameters()
        ->set('baselinker_api_url', '%env(BASELINKER_API_URL)%');

    $containerConfigurator->import(
        'services/seo_integration_type.php',
    );

    $services = $containerConfigurator->services();
    $services
        ->set('lemisoft.sylius_seo_integration_plugin.cache.adapter.filesystem')
        ->parent('cache.adapter.filesystem')
        ->tag('cache.pool', ['namespace' => 'lemisoft.sylius_seo_integration_plugin.cache_filesystem']);

    $services
        ->set(
            'lemisoft.sylius_seo_integration_plugin.service.seo_integration.seo_integration_cache_service',
            SeoIntegrationCacheService::class,
        )
        ->args([
            service('lemisoft.sylius_seo_integration_plugin.cache.adapter.filesystem'),

        ]);
};
