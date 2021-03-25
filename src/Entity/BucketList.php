<?php

namespace App\Entity;

use App\Repository\BucketListRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BucketListRepository::class)
 */
class BucketList
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Veuillez renseigner un titre !")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="3 caractères minimum svp !",
     *     maxMessage="255 caractères max svp !"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     *  @Assert\NotBlank(message="Veuillez renseigner une description !")
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @Assert\NotBlank(message="Veuillez renseigner un auteur!")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="3 caractères minimum svp !",
     *     maxMessage="255 caractères max svp !"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @Assert\NotBlank(message="Veuillez renseigner ce champ!")
     * @ORM\Column(type="boolean", options={"default": true})
     */
    private $isPublished = true;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="integer", options={"default" = 0})
     */
    private $likes = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }
}
