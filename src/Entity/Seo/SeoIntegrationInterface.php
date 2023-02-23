<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Entity\Seo;

interface SeoIntegrationInterface
{
    public function getId(): ?int;

    public function getType(): ?string;

    public function setType(?string $type): void;

    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getConfiguration(): array;

    public function setConfiguration(array $configuration): void;

    public function getFirstPlace(): ?string;
}
