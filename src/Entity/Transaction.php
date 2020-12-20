<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransactionRepository::class)
 */
class Transaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Compte::class, mappedBy="transaction")
     */
    private $transaction;

    /**
     * @ORM\OneToOne(targetEntity=Compte::class, cascade={"persist", "remove"})
     */
    private $compte_debite;

    /**
     * @ORM\OneToOne(targetEntity=Compte::class, cascade={"persist", "remove"})
     */
    private $compte_credite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $montant;

    public function __construct()
    {
        $this->transaction = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Compte[]
     */
    public function getTransaction(): Collection
    {
        return $this->transaction;
    }

    public function addTransaction(Compte $transaction): self
    {
        if (!$this->transaction->contains($transaction)) {
            $this->transaction[] = $transaction;
            $transaction->addTransaction($this);
        }

        return $this;
    }

    public function removeTransaction(Compte $transaction): self
    {
        if ($this->transaction->removeElement($transaction)) {
            $transaction->removeTransaction($this);
        }

        return $this;
    }

    public function getCompteDebite(): ?Compte
    {
        return $this->compte_debite;
    }

    public function setCompteDebite(?Compte $compte_debite): self
    {
        $this->compte_debite = $compte_debite;

        return $this;
    }

    public function getCompteCredite(): ?Compte
    {
        return $this->compte_credite;
    }

    public function setCompteCredite(?Compte $compte_credite): self
    {
        $this->compte_credite = $compte_credite;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(?string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }
}
