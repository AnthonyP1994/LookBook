<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\UpdatableEntity;
use App\Repository\AddressRepository;
// use Doctrine\Common\Collections\Collection;
// use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address implements UpdatableEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $postCode;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'string', length: 255)]
    private $street;

    #[ORM\Column(type: 'integer')]
    private $number;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $supplement;

    // #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'addresses')]
    // private $users;

    // public function __construct()
    // {
    //     $this->users = new ArrayCollection();
    // }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getSupplement(): ?string
    {
        return $this->supplement;
    }

    public function setSupplement(?string $supplement): self
    {
        $this->supplement = $supplement;

        return $this;
    }

    // /**
    //  * @return Collection|User[]
    //  */
    // public function getUsers(): Collection
    // {
    //     return $this->users;
    // }

    // public function addUser(User $user): self
    // {
    //     if (!$this->users->contains($user)) {
    //         $this->users[] = $user;
    //         $user->addAddress($this);
    //     }

    //     return $this;
    // }

    // public function removeUser(User $user): self
    // {
    //     if ($this->users->removeElement($user)) {
    //         $user->removeAddress($this);
    //     }

    //     return $this;
    // }
}