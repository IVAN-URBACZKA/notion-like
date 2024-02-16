<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\InteractionRepository;

#[ORM\Entity(repositoryClass: InteractionRepository::class)]
class Interaction
{

    const TEL = 'Téléphone';
    const EMAIL = 'Email';
    const RESEAUX_SOCIAUX = 'Réseaux sociaux';

    const HIGH = "Important";
    const MIDDLE = "Moyenne";
    const LOW = "Basse";

    const COMPLETED = "Terminé";
    const INPROGRESS = 'En cours';

    private static $typesValides = [
        SELF::TEL,
        SELF::EMAIL, 
        SELF::RESEAUX_SOCIAUX
    ];

    private static $priorityValides = [
        SELF::HIGH,
        SELF::MIDDLE,
        SELF::LOW
    ];

    private static $statutValides = [
        SELF::COMPLETED,
        SELF::INPROGRESS
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 50)]
    private ?string $typeInteraction = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $report = null;

    #[ORM\Column(length: 20)]
    private ?string $priority = null;

    #[ORM\Column(length: 20)]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'interaction')]
    private ?Contact $contact = null;

    public function __construct(){
        $this->date = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getTypeInteraction(): ?string
    {
        return $this->typeInteraction;
    }

    public function setTypeInteraction(string $type): static
    {
         
        if (!in_array($type, self::$typesValides)) {
            throw new InvalidArgumentException("Type d'interaction invalide.");
        }
        $this->typeInteraction = $type;

        return $this;
    }

    public static function getTypesValides() {
        return self::$typesValides;
    }

    public function getReport(): ?string
    {
        return $this->report;
    }

    public function setReport(string $report): static
    {
        $this->report = $report;

        return $this;
    }

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function setPriority(string $typePriority): static
    {

        if(!in_array($typePriority, self::$priorityValides)){
            throw new InvalidArgumentException("Type de priorité invalide.");
        }
        $this->priority = $typePriority;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $typeStatut): static
    {
        if(!in_array($typeStatut, self::$statutValides)){
            throw new InvalidArgumentException("Type de statut invalide.");
        }
        $this->statut = $typeStatut;

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): static
    {
        $this->contact = $contact;

        return $this;
    }
}
