<?php

declare(strict_types=1);

namespace Lemisoft\Tests\SyliusSeoIntegrationPlugin\Unit\Service\SeoIntegration\SeoIntegrationService;

use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\SeoIntegrationCacheService;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\SeoIntegrationService;
use Lemisoft\Tests\SyliusSeoIntegrationPlugin\Unit\UnitTestBase;
use PHPUnit\Framework\TestCase;
use Sylius\Component\Registry\ServiceRegistry;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class FindIntegrationsTest extends UnitTestBase
{
    public function testFindIntegrationsByPlace(): void
    {
        $serviceRegistryMock = $this->createMock(ServiceRegistry::class);

        $repoMock = $this->getMockBuilder(RepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $seoIntegrationCacheServiceMock = $this->getMockBuilder(SeoIntegrationCacheService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $seoIntegrationCacheServiceMock->expects(TestCase::once())
            ->method('getSeoIntegrations')
            ->willReturn($this->addCacheItemData(null, [$this->googleSeoIntegration, $this->facebookSeoIntegration]));

        $service = new SeoIntegrationService($serviceRegistryMock, $repoMock, $seoIntegrationCacheServiceMock);

        self::assertEquals(
            [$this->facebookSeoIntegration],
            $service->findIntegrations(self::FACEBOOK_INTEGRATION_PLACE),
        );
    }

    public function testNotFindIntegrationsByPlace(): void
    {
        $serviceRegistryMock = $this->createMock(ServiceRegistry::class);

        $repoMock = $this->getMockBuilder(RepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $seoIntegrationCacheServiceMock = $this->getMockBuilder(SeoIntegrationCacheService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $seoIntegrationCacheServiceMock->expects(TestCase::once())
            ->method('getSeoIntegrations')
            ->willReturn($this->addCacheItemData(null, [$this->facebookSeoIntegration]));

        $service = new SeoIntegrationService($serviceRegistryMock, $repoMock, $seoIntegrationCacheServiceMock);

        self::assertEquals([], $service->findIntegrations(self::GOOGLE_INTEGRATION_PLACE));
    }

    protected function setUp(): void
    {
        parent::setUp();
    }
}
