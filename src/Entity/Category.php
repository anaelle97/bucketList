<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=BucketList::class, mappedBy="category")
     */
    private $bucketLists;

    public function __construct()
    {
        $this->bucketLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|BucketList[]
     */
    public function getBucketLists(): Collection
    {
        return $this->bucketLists;
    }

    public function addBucketList(BucketList $bucketList): self
    {
        if (!$this->bucketLists->contains($bucketList)) {
            $this->bucketLists[] = $bucketList;
            $bucketList->setCategory($this);
        }

        return $this;
    }

    public function removeBucketList(BucketList $bucketList): self
    {
        if ($this->bucketLists->removeElement($bucketList)) {
            // set the owning side to null (unless already changed)
            if ($bucketList->getCategory() === $this) {
                $bucketList->setCategory(null);
            }
        }

        return $this;
    }
}
