<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Controller\Admin;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SeoIntegrationController extends ResourceController
{
    public function getSeoIntegrationTypesAction(Request $request, string $template): Response
    {
        return $this->render(
            $template,
            [
                'types' => $this->get('lemisoft.sylius_seo_integration_plugin.registry.seo-integration-type')->all(),
                'metadata' => $this->metadata,
            ],
        );
    }
}
