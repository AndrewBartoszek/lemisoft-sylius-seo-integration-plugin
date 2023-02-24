<?php

declare(strict_types=1);

namespace Lemisoft\Tests\SyliusSeoIntegrationPlugin\Unit;

use Lemisoft\SyliusSeoIntegrationPlugin\Entity\Seo\SeoIntegration;
use Lemisoft\SyliusSeoIntegrationPlugin\Entity\Seo\SeoIntegrationInterface;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationRenderType;
use ReflectionClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Cache\CacheItem;

class UnitTestBase extends KernelTestCase
{
    protected const FACEBOOK_INTEGRATION_TYPE = 'facebook';
    protected const FACEBOOK_INTEGRATION_CODE = 'facebook-code';
    protected const FACEBOOK_INTEGRATION_PLACE = SeoIntegrationRenderType::HEAD;

    protected const GOOGLE_INTEGRATION_TYPE = 'google';
    protected const GOOGLE_INTEGRATION_CODE = 'google-code';
    protected const GOOGLE_INTEGRATION_PLACE = SeoIntegrationRenderType::BODY_AFTER_BODY;

    protected SeoIntegration $facebookSeoIntegration;
    protected SeoIntegration $googleSeoIntegration;

    public static function getProtectedProperty(mixed $object, string $property): mixed
    {
        $reflectedClass = new ReflectionClass($object);
        $reflection = $reflectedClass->getProperty($property);
        $reflection->setAccessible(true);

        return $reflection->getValue($object);
    }

    public static function setProtectedProperty(mixed $object, string $property, mixed $value): void
    {
        $reflectedClass = new ReflectionClass($object);
        $reflection = $reflectedClass->getProperty($property);
        $reflection->setAccessible(true);

        $reflection->setValue($object, $value);
    }

    protected function setUp(): void
    {
        $this->facebookSeoIntegration = new SeoIntegration();
        $this->facebookSeoIntegration->setType(self::FACEBOOK_INTEGRATION_TYPE);
        $this->facebookSeoIntegration->setConfiguration([
            [
                'code'  => self::FACEBOOK_INTEGRATION_CODE,
                'place' => self::FACEBOOK_INTEGRATION_PLACE,
            ],
        ]);
        $this->googleSeoIntegration = new SeoIntegration();
        $this->googleSeoIntegration->setType(self::GOOGLE_INTEGRATION_TYPE);
        $this->googleSeoIntegration->setConfiguration([
            [
                'code'  => self::GOOGLE_INTEGRATION_CODE,
                'place' => self::GOOGLE_INTEGRATION_PLACE,
            ],
        ]);
    }

    /**
     * @param SeoIntegrationInterface[] $data
     */
    protected function addCacheItemData(?CacheItem $cacheItem = null, array $data = []): CacheItem
    {
        if (null === $cacheItem) {
            $cacheItem = new CacheItem();
        }

        $cacheItem->set($data);
        self::setProtectedProperty($cacheItem, 'isHit', true);

        return $cacheItem;
    }
}
