<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration;

use Lemisoft\SyliusSeoIntegrationPlugin\Entity\Seo\SeoIntegrationInterface;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType\SeoIntegrationTypeInterface;
use Sylius\Component\Registry\ServiceRegistry;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class SeoIntegrationService
{
    public function __construct(
        protected ServiceRegistry $seoIntegrationTypeRegistry,
        protected RepositoryInterface $repository,
        protected SeoIntegrationCacheService $seoCache,
    ) {
    }

    public function deleteSeoCache(): void
    {
        $this->seoCache->deleteSeoIntegrationCache();
    }

    /**
     * @return SeoIntegrationInterface[]
     */
    public function getAllIntegrations(): array
    {
        $cachedSeoIntegrations = $this->seoCache->getSeoIntegrations();

        if (!$cachedSeoIntegrations->isHit()) {
            /** @var SeoIntegrationInterface[] $integrations */
            $integrations = $this->repository->findAll();
            $this->seoCache->setSeoIntegrations($integrations);
        } else {
            /** @var SeoIntegrationInterface[] $integrations */
            $integrations = $cachedSeoIntegrations->get();
        }

        return $integrations;
    }

    /**
     * @return SeoIntegrationInterface[]
     */
    public function findIntegrations(string $place): array
    {
        $foundIntegrations = [];
        $allIntegrations = $this->getAllIntegrations();

        foreach ($allIntegrations as $integration) {
            if ($integration->getFirstPlace() === $place) {
                $foundIntegrations[] = $integration;
            }
        }

        return $foundIntegrations;
    }

    public function findRegisterType(?string $seoIntegrationType = null): ?SeoIntegrationTypeInterface
    {
        if (null === $seoIntegrationType) {
            return null;
        }

        /** @var SeoIntegrationTypeInterface[] $types */
        $types = $this->seoIntegrationTypeRegistry->all();

        foreach ($types as $registerType) {
            if ($registerType->getType() === $seoIntegrationType) {
                return $registerType;
            }
        }

        return null;
    }
}
