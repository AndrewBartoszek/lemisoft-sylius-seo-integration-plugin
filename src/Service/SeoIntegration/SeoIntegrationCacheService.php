<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration;

use Lemisoft\SyliusSeoIntegrationPlugin\Entity\Seo\SeoIntegrationInterface;
use Symfony\Contracts\Cache\CacheInterface;

class SeoIntegrationCacheService
{
    const SEO_INTEGRATIONS_NAME = 'seo_integrations';

    public CacheInterface $cache;
    /** @var int W sekundach */
    public int $expirationAfter;

    public function __construct(CacheInterface $cache, int $expirationAfter)
    {
        $this->cache = $cache;
        $this->expirationAfter = $expirationAfter;
    }

    public function getSeoIntegrations()
    {
        return $this->cache->getItem(
            self::SEO_INTEGRATIONS_NAME
        );
    }

    /**
     * @param SeoIntegrationInterface[] $seoIntegrations
     *
     * @return void
     */
    public function setSeoIntegrations(array $seoIntegrations)
    {
        $cacheItem = $this->getSeoIntegrations();
        $cacheItem->set($seoIntegrations);
        $cacheItem->expiresAfter($this->expirationAfter);

        $this->cache->save($cacheItem);
    }
}
