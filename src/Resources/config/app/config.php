<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $containerConfigurator) {
    $containerConfigurator->import(
        '@LemisoftSyliusSeoIntegrationPlugin/src/Resources/config/sylius/sylius_resource.yaml'
    );
    $containerConfigurator->import(
        '@LemisoftSyliusSeoIntegrationPlugin/src/Resources/config/sylius/sylius_grid.yaml'
    );
    $containerConfigurator->import(
        '@LemisoftSyliusSeoIntegrationPlugin/src/Resources/config/sylius/events.yaml'
    );
};
