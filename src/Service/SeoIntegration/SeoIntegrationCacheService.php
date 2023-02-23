<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration;

use Lemisoft\SyliusSeoIntegrationPlugin\Entity\Seo\SeoIntegrationInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Contracts\Cache\ItemInterface;

class SeoIntegrationCacheService
{
    public const SEO_INTEGRATIONS_NAME = 'seo_integrations';

    public function __construct(protected AdapterInterface $cache)
    {
    }

    public function getSeoIntegrations(): ItemInterface
    {
        return $this->cache->getItem(
            self::SEO_INTEGRATIONS_NAME,
        );
    }

    /**
     * @param SeoIntegrationInterface[] $seoIntegrations
     */
    public function setSeoIntegrations(array $seoIntegrations): void
    {
        $cacheItem = $this->getSeoIntegrations();
        $cacheItem->set($seoIntegrations);

        $this->cache->save($cacheItem);
    }

    public function deleteSeoIntegrationCache(): void
    {
        $this->cache->deleteItem(self::SEO_INTEGRATIONS_NAME);
    }
}
