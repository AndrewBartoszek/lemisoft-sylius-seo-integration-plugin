<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model;

enum SeoIntegrationRenderType: string
{
    case HEAD = 'head';
    case BODY_BEFORE_BODY = 'body-before-body';
    case BODY_AFTER_BODY = 'body-after-body';

    /**
     * @return string[]
     */
    public static function toArray(): array
    {
        return array_map(
            static fn (SeoIntegrationRenderType $enum) => $enum->value,
            SeoIntegrationRenderType::cases(),
        );
    }
}
