<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Controller\Admin;

use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\SeoIntegrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SeoIntegrationController extends AbstractController
{
    public SeoIntegrationService $seoIntegrationService;

    public function __construct(SeoIntegrationService $seoIntegrationService)
    {
        $this->seoIntegrationService = $seoIntegrationService;
    }

    public function getSeoIntegrationScriptCodeAction(Request $request, $type): Response
    {
        $seoIntegrationType = $this->seoIntegrationService->findRegisterType($type);

        $script = $this->renderView(
            $seoIntegrationType->getTemplate(),
            [
                'isForAdminEditView' => true,
            ],
        );

        return $this->render(
            $request->get('template'),
            [
                'script' => $script,
            ],
        );
    }
}
