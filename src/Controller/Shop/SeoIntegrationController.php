<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Controller\Shop;

use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationRenderType;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\SeoIntegrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SeoIntegrationController extends AbstractController
{
    public SeoIntegrationService $seoIntegrationService;

    public function __construct(SeoIntegrationService $seoIntegrationService)
    {
        $this->seoIntegrationService = $seoIntegrationService;
    }

    public function getSeoIntegrationScriptAction(string $place, Request $request): Response
    {
        $template = $request->get('template');
        if (!in_array($place, SeoIntegrationRenderType::toArray())) {
            return new Response('');
        }

        $integrations = $this->seoIntegrationService->findIntegrations($place);

        $scripts = [];
        foreach ($integrations as $integration) {
            $seoIntegrationType = $this->seoIntegrationService->findRegisterType($integration->getType());
            $scripts[] = $this->renderView(
                $seoIntegrationType->getTemplate(),
                ['integration' => $integration]
            );
        }

        return $this->render(
            $template,
            ['scripts' => $scripts]
        );
    }
}
