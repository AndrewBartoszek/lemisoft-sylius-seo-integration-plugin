<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Lemisoft\SyliusSeoIntegrationPlugin\EventListener\MenuBuilderListener;
use Lemisoft\SyliusSeoIntegrationPlugin\EventListener\SeoIntegrationListener;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Factory\SeoIntegrationFactory;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\SeoIntegrationCacheService;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\SeoIntegrationService;

return static function (ContainerConfigurator $containerConfigurator) {
    $containerConfigurator->parameters()
        ->set('baselinker_api_url', '%env(BASELINKER_API_URL)%');

    $containerConfigurator->import(
        'services/seo_integration_type.php'
    );
    $containerConfigurator->import(
        'services/form_type.php'
    );
    $containerConfigurator->import(
        'services/controller.php'
    );

    $services = $containerConfigurator->services();
    $services
        ->set('lemisoft.sylius_seo_integration_plugin.cache.adapter.filesystem')
        ->parent('cache.adapter.filesystem')
        ->tag('cache.pool', ['namespace' => 'lemisoft.sylius_seo_integration_plugin.cache_filesystem']);

    $services
        ->set(
            'lemisoft.sylius_seo_integration_plugin.event_listener.menu_builder_listener',
            MenuBuilderListener::class
        )
        ->tag('kernel.event_listener', ['event' => 'sylius.menu.admin.main', 'method' => 'addAdminMenuItems']);

    $services
        ->set(
            'lemisoft.sylius_seo_integration_plugin.service.seo_integration.factory_seo_integration_factory',
            SeoIntegrationFactory::class
        )
        ->decorate('lemisoft_sylius_seo_integration_plugin.factory.seo_integration')
        ->args([
            '%lemisoft_sylius_seo_integration_plugin.model.seo_integration.class%',
            service('lemisoft.sylius_seo_integration_plugin.registry.seo-integration-type'),
        ]);

    $services
        ->set(
            'lemisoft.sylius_seo_integration_plugin.service.seo_integration.seo_integration_service',
            SeoIntegrationService::class
        )
        ->args([
            service('lemisoft.sylius_seo_integration_plugin.registry.seo-integration-type'),
            service('lemisoft_sylius_seo_integration_plugin.repository.seo_integration'),
            service('lemisoft.sylius_seo_integration_plugin.service.seo_integration.seo_integration_cache_service'),
        ]);

    $services
        ->set(
            'lemisoft.sylius_seo_integration_plugin.service.seo_integration.seo_integration_cache_service',
            SeoIntegrationCacheService::class
        )
        ->args([
            service('lemisoft.sylius_seo_integration_plugin.cache.adapter.filesystem'),

        ]);
    $services
        ->set(
            'lemisoft.sylius_seo_integration_plugin.event_listener.seo_integration_listener',
            SeoIntegrationListener::class
        )
        ->args([
            service('lemisoft.sylius_seo_integration_plugin.service.seo_integration.seo_integration_service'),
        ])
        ->tag('kernel.event_listener',
            [
                'event'  => 'lemisoft_sylius_seo_integration_plugin.seo_integration.post_update',
                'method' => 'refreshSeoIntegrationCache',
            ]
        )
        ->tag('kernel.event_listener',
            [
                'event'  => 'lemisoft_sylius_seo_integration_plugin.seo_integration.post_delete',
                'method' => 'refreshSeoIntegrationCache',
            ]
        )
        ->tag('kernel.event_listener',
            [
                'event'  => 'lemisoft_sylius_seo_integration_plugin.seo_integration.post_create',
                'method' => 'refreshSeoIntegrationCache',
            ]
        );
};
