<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Lemisoft\SyliusSeoIntegrationPlugin\Controller\Admin\SeoIntegrationController as SeoIntegrationAdminController;
use Lemisoft\SyliusSeoIntegrationPlugin\Controller\Shop\SeoIntegrationController;

return static function (ContainerConfigurator $containerConfigurator) {
    $services = $containerConfigurator->services();
    $services
        ->defaults()
        ->autoconfigure(true)
        ->autowire(true);
    $services
        ->set('lemisoft.sylius_seo_integration_plugin.controller.shop.seo_integration_controller', SeoIntegrationController::class)
        ->args([
            service('lemisoft.sylius_seo_integration_plugin.service.seo_integration.seo_integration_service'),

        ])
        ->tag('controller.service_arguments');
    $services
        ->set('lemisoft.sylius_seo_integration_plugin.controller.admin.seo_integration_controller', SeoIntegrationAdminController::class)
        ->args([
            service('lemisoft.sylius_seo_integration_plugin.service.seo_integration.seo_integration_service'),

        ])
        ->tag('controller.service_arguments');
};
