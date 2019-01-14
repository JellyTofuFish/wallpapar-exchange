<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Picture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @var UploadedFile
     */
    private $file;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="pictures")
     */
    private $picture_categories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="picture", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="pictures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    
    public function __construct()
    {
        $this->picture_categories = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture($picture): self
    {
        $this->picture = $picture;

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

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile|null $file
     */
    public function setFile(UploadedFile $file = null)
    {
        if ( $file) {
            $this->setUpdatedAt();
        }
        $this->file = $file;
    }

    /**
     * @return Collection|Category[]
     */
    public function getPictureCategories(): Collection
    {
        return $this->picture_categories;
    }

    public function addPictureCategory(Category $pictureCategory): self
    {
        if (!$this->picture_categories->contains($pictureCategory)) {
            $this->picture_categories[] = $pictureCategory;
        }

        return $this;
    }

    public function removePictureCategory(Category $pictureCategory): self
    {
        if ($this->picture_categories->contains($pictureCategory)) {
            $this->picture_categories->removeElement($pictureCategory);
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPicture($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getPicture() === $this) {
                $comment->setPicture(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function __toString() {
        return (string) $this->title;
    }

    public function getImage() {
        return $this->picture;
    }
    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $created_at;
    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updated_at;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * @ORM\PrePersist
     * @return $this
     */
    public function setCreatedAt()
    {
        $this->created_at = new \DateTime('now');
        $this->updated_at = new \DateTime('now');

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    /**
     * @ORM\PreUpdate
     * @return $this
     */
    public function setUpdatedAt()
    {
        $this->updated_at = new \DateTime('now');
        return $this;
    }


}
