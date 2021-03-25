<?php

namespace App\Entity;

use App\Repository\ReactionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ReactionRepository::class)
 */
class Reaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Veuillez renseigner un pseudo!")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="3 caractères minimum svp !",
     *     maxMessage="255 caractères max svp !"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @Assert\NotBlank(message="Veuillez renseigner un message !")
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity=BucketList::class, inversedBy="reactions")
     */
    private $bucketList;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

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

    public function getBucketList(): ?BucketList
    {
        return $this->bucketList;
    }

    public function setBucketList(?BucketList $bucketList): self
    {
        $this->bucketList = $bucketList;

        return $this;
    }
}
