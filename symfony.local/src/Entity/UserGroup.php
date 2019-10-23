<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserGroupRepository")
 */
class UserGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userGroups")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",nullable=false)
     */
    private $user_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $valid_before;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Group", inversedBy="userGroups")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id",nullable=false)
     */
    private $group_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getValidBefore(): ?\DateTimeInterface
    {
        return $this->valid_before;
    }

    public function setValidBefore(\DateTimeInterface $valid_before): self
    {
        $this->valid_before = $valid_before;

        return $this;
    }

    public function getGroupId(): ?Group
    {
        return $this->group_id;
    }

    public function setGroupId(?Group $group_id): self
    {
        $this->group_id = $group_id;

        return $this;
    }

}
