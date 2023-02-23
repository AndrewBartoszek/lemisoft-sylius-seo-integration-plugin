<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Controller\Admin;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Component\Registry\ServiceRegistryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SeoIntegrationResourceController extends ResourceController
{
    public function getSeoIntegrationTypesAction(Request $request, string $template): Response
    {
        /** @var ServiceRegistryInterface $registrySeoIntegrationType */
        $registrySeoIntegrationType = $this->get('lemisoft.sylius_seo_integration_plugin.registry.seo-integration-type');

        return $this->render(
            $template,
            [
                'types' => $registrySeoIntegrationType->all(),
                'metadata' => $this->metadata,
            ],
        );
    }
}
