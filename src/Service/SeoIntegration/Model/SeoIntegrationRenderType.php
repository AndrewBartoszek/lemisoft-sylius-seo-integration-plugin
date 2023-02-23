<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model;

use MyCLabs\Enum\Enum;

/**
 * @psalm-immutable
 *
 * @psalm-suppress MissingTemplateParam
 */
class SeoIntegrationRenderType extends Enum
{
    public const HEAD = 'head';
    public const BODY_BEFORE_BODY = 'body-before-body';
    public const BODY_AFTER_BODY = 'body-after-body';
}
