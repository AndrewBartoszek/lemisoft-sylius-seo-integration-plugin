<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Service\SeoIntegration\Model;

use MyCLabs\Enum\Enum;

class SeoIntegrationRenderType extends Enum
{
    const HEAD = 'head';
    const BODY_BEFORE_BODY = 'body-before-body';
    const BODY_AFTER_BODY = 'body-after-body';
}
