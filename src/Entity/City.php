<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CityRepository::class)]
class City
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $zipcode = null;

    #[ORM\OneToMany(mappedBy: 'city_id', targetEntity: User::class)]
    private Collection $user_id;

    #[ORM\OneToMany(mappedBy: 'city_id', targetEntity: Restaurant::class)]
    private Collection $restaurant_id;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
        $this->restaurant_id = new ArrayCollection();
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

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id->add($userId);
            $userId->setCityId($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        if ($this->user_id->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getCityId() === $this) {
                $userId->setCityId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Restaurant>
     */
    public function getRestaurantId(): Collection
    {
        return $this->restaurant_id;
    }

    public function addRestaurantId(Restaurant $restaurantId): self
    {
        if (!$this->restaurant_id->contains($restaurantId)) {
            $this->restaurant_id->add($restaurantId);
            $restaurantId->setCityId($this);
        }

        return $this;
    }

    public function removeRestaurantId(Restaurant $restaurantId): self
    {
        if ($this->restaurant_id->removeElement($restaurantId)) {
            // set the owning side to null (unless already changed)
            if ($restaurantId->getCityId() === $this) {
                $restaurantId->setCityId(null);
            }
        }

        return $this;
    }
}
