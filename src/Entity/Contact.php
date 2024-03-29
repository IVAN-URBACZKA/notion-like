<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Metadata\ApiResource;



#[UniqueEntity(
    fields: ['email'],
    message: 'Ce Mail déjà existant',
)]
#[ORM\Entity(repositoryClass: ContactRepository::class)]
#[ApiResource]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotNull]
    #[ORM\Column(length: 25)]
    private ?string $name = null;

    #[Assert\NotNull]
    #[ORM\Column(length: 25)]
    private ?string $firstName = null;

    
    #[Assert\Email]
    #[ORM\Column(name: 'email', type: 'string', length: 50, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\ManyToOne(inversedBy: 'contact')]
    private ?User $user = null;

    #[ORM\OneToMany(targetEntity: Interaction::class, mappedBy: 'contact')]
    private Collection $interaction;

    public function __construct()
    {
        $this->interaction = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Interaction>
     */
    public function getInteraction(): Collection
    {
        return $this->interaction;
    }

    public function addInteraction(Interaction $interaction): static
    {
        if (!$this->interaction->contains($interaction)) {
            $this->interaction->add($interaction);
            $interaction->setContact($this);
        }

        return $this;
    }

    public function removeInteraction(Interaction $interaction): static
    {
        if ($this->interaction->removeElement($interaction)) {
            // set the owning side to null (unless already changed)
            if ($interaction->getContact() === $this) {
                $interaction->setContact(null);
            }
        }

        return $this;
    }
}
