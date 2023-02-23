<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Controller\Shop;

use Exception;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationRenderType;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\SeoIntegrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
class SeoIntegrationController extends AbstractController
{
    public function __construct(public SeoIntegrationService $seoIntegrationService)
    {
    }

    /**
     * @psalm-suppress InternalMethod
     */
    public function getSeoIntegrationScriptAction(string $place, Request $request): Response
    {
        /** @var string|null $template */
        $template = $request->get('template');
        if (null === $template) {
            throw new Exception('Kontroler wymaga przekazania templatki');
        }

        if (!in_array($place, SeoIntegrationRenderType::toArray(), true)) {
            return new Response('');
        }

        $integrations = $this->seoIntegrationService->findIntegrations($place);

        $scripts = [];
        foreach ($integrations as $integration) {
            $seoIntegrationType = $this->seoIntegrationService->findRegisterType($integration->getType());
            if (null !== $seoIntegrationType) {
                $scripts[] = $this->renderView(
                    $seoIntegrationType->getTemplate(),
                    ['integration' => $integration],
                );
            }
        }

        return $this->render(
            $template,
            ['scripts' => $scripts],
        );
    }
}
