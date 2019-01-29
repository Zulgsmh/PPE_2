<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lignefraisforfait
 *
 * @ORM\Table(name="lignefraisforfait", indexes={@ORM\Index(name="idVisiteur", columns={"idVisiteur"}), @ORM\Index(name="idFraisForfait", columns={"idFraisForfait"}), @ORM\Index(name="mois", columns={"mois"})})
 * @ORM\Entity
 */
class Lignefraisforfait
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="idVisiteur", type="string", length=4, nullable=false, options={"fixed"=true})
     */
    private $idvisiteur;

    /**
     * @var string
     *
     * @ORM\Column(name="mois", type="string", length=6, nullable=false, options={"fixed"=true})
     */
    private $mois;

    /**
     * @var string
     *
     * @ORM\Column(name="idFraisForfait", type="string", length=3, nullable=false, options={"fixed"=true})
     */
    private $idfraisforfait;

    /**
     * @var int|null
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var float|null
     *
     * @ORM\Column(name="montant", type="float", precision=10, scale=0, nullable=true)
     */
    private $montant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdvisiteur(): ?string
    {
        return $this->idvisiteur;
    }

    public function setIdvisiteur(string $idvisiteur): self
    {
        $this->idvisiteur = $idvisiteur;

        return $this;
    }

    public function getMois(): ?string
    {
        return $this->mois;
    }

    public function setMois(string $mois): self
    {
        $this->mois = $mois;

        return $this;
    }

    public function getIdfraisforfait(): ?string
    {
        return $this->idfraisforfait;
    }

    public function setIdfraisforfait(string $idfraisforfait): self
    {
        $this->idfraisforfait = $idfraisforfait;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(?float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }


}
