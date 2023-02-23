<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Controller\Admin;

use Exception;
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
    public function getSeoIntegrationScriptCodeAction(Request $request, string $type): Response
    {
        /** @var string|null $template */
        $template = $request->get('template');

        if (null === $template) {
            throw new Exception('Kontroler wymaga przekazania templatki');
        }

        $seoIntegrationType = $this->seoIntegrationService->findRegisterType($type);

        if (null === $seoIntegrationType) {
            throw new Exception(sprintf('Nie znaleziono zarejestrowanego typu integracji seo: %s', $type));
        }

        $script = $this->renderView(
            $seoIntegrationType->getTemplate(),
            [
                'isForAdminEditView' => true,
            ],
        );

        return $this->render(
            $template,
            [
                'script' => $script,
            ],
        );
    }
}
