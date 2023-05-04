<?php
namespace App\Entity;



use App\Repository\ReviewRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'review_user_id')]
    private ?user $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'review_restaurant_id')]
    private ?restaurant $restaurant_id = null;

    #[ORM\OneToMany(mappedBy: 'review_answer_id', targetEntity: Review::class)]
    private Collection $review_answer;

    public function __construct()
    {
        $this->review_answer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

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

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?user $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getRestaurantId(): ?restaurant
    {
        return $this->restaurant_id;
    }

    public function setRestaurantId(?restaurant $restaurant_id): self
    {
        $this->restaurant_id = $restaurant_id;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviewAnswer(): Collection
    {
        return $this->review_answer;
    }

    public function addReviewAnswer(Review $reviewAnswer): self
    {
        if (!$this->review_answer->contains($reviewAnswer)) {
            $this->review_answer->add($reviewAnswer);
            $reviewAnswer->setReviewId($this);
        }

        return $this;
    }

    public function removeReviewAnswer(Review $reviewAnswer): self
    {
        if ($this->review_answer->removeElement($reviewAnswer)) {
            // set the owning side to null (unless already changed)
            if ($reviewAnswer->getReviewId() === $this) {
                $reviewAnswer->setReviewId(null);
            }
        }

        return $this;
    }
}
