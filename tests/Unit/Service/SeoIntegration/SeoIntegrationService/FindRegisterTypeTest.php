<?php

declare(strict_types=1);

namespace Lemisoft\Tests\SyliusSeoIntegrationPlugin\Unit\Service\SeoIntegration\SeoIntegrationService;

use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType\FacebookSeoIntegrationType;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model\SeoIntegrationType\GoogleAnalyticsSeoIntegrationType;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\SeoIntegrationCacheService;
use Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\SeoIntegrationService;
use Lemisoft\Tests\SyliusSeoIntegrationPlugin\Unit\UnitTestBase;
use PHPUnit\Framework\TestCase;
use Sylius\Component\Registry\ServiceRegistry;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class FindRegisterTypeTest extends UnitTestBase
{
    public function testFindRegisterTypeForNull(): void
    {
        $serviceRegistryMock = $this->createMock(ServiceRegistry::class);
        $repoMock = $this->createMock(RepositoryInterface::class);
        $seoIntegrationCacheServiceMock = $this->createMock(SeoIntegrationCacheService::class);

        $service = new SeoIntegrationService($serviceRegistryMock, $repoMock, $seoIntegrationCacheServiceMock);

        self::assertEquals(null, $service->findRegisterType(null));
    }

    public function testFindRegisterType(): void
    {
        $repoMock = $this->createMock(RepositoryInterface::class);
        $seoIntegrationCacheServiceMock = $this->createMock(SeoIntegrationCacheService::class);

        $serviceRegistryMock = $this->getMockBuilder(ServiceRegistry::class)
            ->disableOriginalConstructor()
            ->getMock();

        $facebookSeoIntegrationType = new FacebookSeoIntegrationType();
        $googleAnalyticsSeoIntegrationType = new GoogleAnalyticsSeoIntegrationType();

        $serviceRegistryMock->expects(TestCase::any())
            ->method('all')
            ->willReturn([
                FacebookSeoIntegrationType::TYPE        => $facebookSeoIntegrationType,
                GoogleAnalyticsSeoIntegrationType::TYPE => $googleAnalyticsSeoIntegrationType,
            ]);

        $service = new SeoIntegrationService($serviceRegistryMock, $repoMock, $seoIntegrationCacheServiceMock);

        self::assertEquals(
            $googleAnalyticsSeoIntegrationType,
            $service->findRegisterType(GoogleAnalyticsSeoIntegrationType::TYPE),
        );

        self::assertEquals(
            null,
            $service->findRegisterType('niezarejestrowany_typ'),
        );


        $service = new SeoIntegrationService($serviceRegistryMock, $repoMock, $seoIntegrationCacheServiceMock);

        self::assertEquals(null, $service->findRegisterType(null));
    }

    protected function setUp(): void
    {
        parent::setUp();
    }
}
