<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\EventListener;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

class MenuBuilderListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        $configuration = $menu->getChild('configuration');

        $configuration->addChild('seo_integration', ['route' => 'lemisoft_sylius_seo_integration_plugin_admin_seo_integration_index'])
            ->setLabel('lemisoft_sylius_seo_integration_plugin.menu.seo_integration')
            ->setLabelAttribute('icon', 'magnify');
    }
}
