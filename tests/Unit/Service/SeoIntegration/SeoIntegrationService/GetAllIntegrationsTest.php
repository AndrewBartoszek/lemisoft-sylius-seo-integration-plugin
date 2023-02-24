<?php

declare(strict_types=1);

namespace Lemisoft\Tests\SyliusSeoIntegrationPlugin\Unit\Service\SeoIntegration\SeoIntegrationService;

use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\SeoIntegrationCacheService;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\SeoIntegrationService;
use Lemisoft\Tests\SyliusSeoIntegrationPlugin\Unit\UnitTestBase;
use PHPUnit\Framework\TestCase;
use Sylius\Component\Registry\ServiceRegistry;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class GetAllIntegrationsTest extends UnitTestBase
{
    public function testGetSeoIntegrationsFromCache(): void
    {
        $serviceRegistryMock = $this->createMock(ServiceRegistry::class);
        $repoMock = $this->createMock(RepositoryInterface::class);

        $seoIntegrationCacheServiceMock = $this->getMockBuilder(SeoIntegrationCacheService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $seoIntegrationCacheServiceMock->expects(TestCase::once())
            ->method('getSeoIntegrations')
            ->willReturn($this->addCacheItemData(null, [$this->facebookSeoIntegration]));

        $service = new SeoIntegrationService($serviceRegistryMock, $repoMock, $seoIntegrationCacheServiceMock);

        self::assertEquals([$this->facebookSeoIntegration], $service->getAllIntegrations());
    }

    public function testFindSeoIntegrationsFromDb(): void
    {
        $serviceRegistryMock = $this->createMock(ServiceRegistry::class);
        $seoIntegrationCacheServiceMock = $this->createMock(SeoIntegrationCacheService::class);

        $repoMock = $this->getMockBuilder(RepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repoMock->expects(TestCase::once())
            ->method('findAll')
            ->willReturn([$this->facebookSeoIntegration]);

        $service = new SeoIntegrationService($serviceRegistryMock, $repoMock, $seoIntegrationCacheServiceMock);

        self::assertEquals([$this->facebookSeoIntegration], $service->getAllIntegrations());
    }

    protected function setUp(): void
    {
        parent::setUp();
    }
}
