<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Entity\Seo;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="lemisoft_seo_integration")
 */
class SeoIntegration implements ResourceInterface, SeoIntegrationInterface
{
    /**
     * @ORM\Column(name="type", type="string", nullable=false, unique=false)
     *
     * @Assert\NotBlank(groups={Constraint::DEFAULT_GROUP})
     *
     */
    protected ?string $type = null;

    /**
     * @ORM\Column(name="name", type="string", nullable=false)
     *
     * @Assert\NotBlank(groups={Constraint::DEFAULT_GROUP})
     *
     */
    protected ?string $name = null;

    /**
     * @ORM\Column(name="configuration", type="json", nullable=false)
     *
     * @Assert\NotBlank(groups={Constraint::DEFAULT_GROUP})
     *
     * @var mixed[]
     */
    protected array $configuration = [];

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    /**
     * @param array $configuration
     */
    public function setConfiguration(array $configuration): void
    {
        $this->configuration = $configuration;
    }

    public function getFirstPlace(): ?string
    {
        $place = null;
        if (isset($this->configuration[0]) && isset($this->configuration[0]['place'])) {
            /** @var string $place */
            $place = $this->configuration[0]['place'];
        }

        return $place;
    }
}
