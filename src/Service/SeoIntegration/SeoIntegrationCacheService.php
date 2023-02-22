<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration;

use Lemisoft\SyliusSeoIntegrationPlugin\Entity\Seo\SeoIntegrationInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class SeoIntegrationCacheService
{
    const SEO_INTEGRATIONS_NAME = 'seo_integrations';

    public function __construct(protected CacheInterface $cache)
    {
    }

    public function getSeoIntegrations(): ItemInterface
    {
        return $this->cache->getItem(
            self::SEO_INTEGRATIONS_NAME
        );
    }

    /**
     * @param SeoIntegrationInterface[] $seoIntegrations
     */
    public function setSeoIntegrations(array $seoIntegrations):void
    {
        $cacheItem = $this->getSeoIntegrations();
        $cacheItem->set($seoIntegrations);

        $this->cache->save($cacheItem);
    }

    public function deleteSeoIntegrationCache(): void
    {
        $this->cache->delete(self::SEO_INTEGRATIONS_NAME);
    }
}
