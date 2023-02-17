<?php

declare(strict_types=1);

namespace Lemisoft\SyliusSeoIntegrationPlugin\Entity\Seo;

use Sylius\Component\Resource\Model\ResourceInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="lemisoft_seo_integration")
 */
class SeoIntegration implements ResourceInterface, SeoIntegrationInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private ?int $id;

    /**
     * @ORM\Column(name="type", type="string", nullable=false, unique=false)
     * @Assert\NotBlank(groups={Constraint::DEFAULT_GROUP})
     * @var string|null
     */
    protected $type;

    /**
     * @ORM\Column(name="name", type="string", nullable=false)
     * @Assert\NotBlank(groups={Constraint::DEFAULT_GROUP})
     * @var string|null
     */
    protected $name;

    /**
     * @ORM\Column(name="configuration", type="array", nullable=false)
     * @Assert\NotBlank(groups={Constraint::DEFAULT_GROUP})
     * @var array|null
     */
    protected $configuration = [];

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array|null
     */
    public function getConfiguration(): ?array
    {
        return $this->configuration;
    }

    /**
     * @param array|null $configuration
     */
    public function setConfiguration(?array $configuration): void
    {
        $this->configuration = $configuration;
    }

    public function getFirstPlace(): ?string
    {
        return isset($this->configuration[0]) && isset($this->configuration[0]['place']) ? $this->configuration[0]['place'] : null;
    }
}
