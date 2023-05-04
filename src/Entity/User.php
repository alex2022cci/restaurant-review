<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\ManyToOne(inversedBy: 'user_id')]
    private ?city $city_id = null;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Restaurant::class)]
    private Collection $restaurant_id;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Review::class)]
    private Collection $review_id;

    public function __construct()
    {
        $this->restaurant_id = new ArrayCollection();
        $this->review_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCityId(): ?city
    {
        return $this->city_id;
    }

    public function setCityId(?city $city_id): self
    {
        $this->city_id = $city_id;

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
            $restaurantId->setUserId($this);
        }

        return $this;
    }

    public function removeRestaurantId(Restaurant $restaurantId): self
    {
        if ($this->restaurant_id->removeElement($restaurantId)) {
            // set the owning side to null (unless already changed)
            if ($restaurantId->getUserId() === $this) {
                $restaurantId->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviewId(): Collection
    {
        return $this->review_id;
    }

    public function addReviewId(Review $reviewId): self
    {
        if (!$this->review_id->contains($reviewId)) {
            $this->review_id->add($reviewId);
            $reviewId->setUserId($this);
        }

        return $this;
    }

    public function removeReviewId(Review $reviewId): self
    {
        if ($this->review_id->removeElement($reviewId)) {
            // set the owning side to null (unless already changed)
            if ($reviewId->getUserId() === $this) {
                $reviewId->setUserId(null);
            }
        }

        return $this;
    }
}
