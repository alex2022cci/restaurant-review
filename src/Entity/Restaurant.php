<?php
namespace App\Entity;



use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'restaurant_id')]
    private ?City $city_id = null;

    #[ORM\ManyToOne(inversedBy: 'restaurant_id')]
    private ?user $user_id = null;

    #[ORM\OneToMany(mappedBy: 'restaurant_picture_id', targetEntity: RestaurantPicture::class)]
    private Collection $Pictures_id;

    #[ORM\OneToMany(mappedBy: 'restaurant_review_id', targetEntity: Review::class)]
    private Collection $review_id;

    public function __construct()
    {
        $this->Pictures_id = new ArrayCollection();
        $this->review_id = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
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

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?user $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection<int, RestaurantPicture>
     */
    public function getPicturesId(): Collection
    {
        return $this->Pictures_id;
    }

    public function addPicturesId(RestaurantPicture $picturesId): self
    {
        if (!$this->Pictures_id->contains($picturesId)) {
            $this->Pictures_id->add($picturesId);
            $picturesId->setRestaurantId($this);
        }

        return $this;
    }

    public function removePicturesId(RestaurantPicture $picturesId): self
    {
        if ($this->Pictures_id->removeElement($picturesId)) {
            // set the owning side to null (unless already changed)
            if ($picturesId->getRestaurantId() === $this) {
                $picturesId->setRestaurantId(null);
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
            $reviewId->setRestaurantId($this);
        }

        return $this;
    }

    public function removeReviewId(Review $reviewId): self
    {
        if ($this->review_id->removeElement($reviewId)) {
            // set the owning side to null (unless already changed)
            if ($reviewId->getRestaurantId() === $this) {
                $reviewId->setRestaurantId(null);
            }
        }

        return $this;
    }
}
