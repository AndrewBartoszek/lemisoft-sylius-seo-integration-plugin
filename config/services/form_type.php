<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Lemisoft\SyliusSeoIntegrationPlugin\Form\SeoIntegrationType;

return static function (ContainerConfigurator $containerConfigurator) {
    $services = $containerConfigurator->services();
    $services
        ->set('lemisoft.sylius_seo_integration_plugin.form.seo_integration_type', SeoIntegrationType::class)
        ->args([
            service('lemisoft.sylius_seo_integration_plugin.service.seo_integration.seo_integration_service'),
            '%lemisoft_sylius_seo_integration_plugin.model.seo_integration.class%',
            ['Default', 'sylius']
        ])
        ->tag('form.type');
};
