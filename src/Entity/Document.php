<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Document
 *
 * @ORM\Table(name="document", indexes={@ORM\Index(name="idFraisForfait", columns={"idFraisForfait"}), @ORM\Index(name="idVisiteur", columns={"idVisiteur"})})
 * @ORM\Entity
 */
class Document
{
    /**
     * @var int
     *
     * @ORM\Column(name="idJustificatif", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idjustificatif;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=250, nullable=false)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="nomJustificatif", type="string", length=255, nullable=false)
     */
    private $nomjustificatif;

    /**
     * @var float
     *
     * @ORM\Column(name="MontantJustificatif", type="float", precision=10, scale=0, nullable=false)
     */
    private $montantjustificatif;

    /**
     * @var \Fraisforfait
     *
     * @ORM\ManyToOne(targetEntity="Fraisforfait")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idFraisForfait", referencedColumnName="id")
     * })
     */
    private $idfraisforfait;

    /**
     * @var \Visiteur
     *
     * @ORM\ManyToOne(targetEntity="Visiteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idVisiteur", referencedColumnName="id")
     * })
     */
    private $idvisiteur;

    public function getIdjustificatif(): ?int
    {
        return $this->idjustificatif;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getNomjustificatif(): ?string
    {
        return $this->nomjustificatif;
    }

    public function setNomjustificatif(string $nomjustificatif): self
    {
        $this->nomjustificatif = $nomjustificatif;

        return $this;
    }

    public function getMontantjustificatif(): ?float
    {
        return $this->montantjustificatif;
    }

    public function setMontantjustificatif(float $montantjustificatif): self
    {
        $this->montantjustificatif = $montantjustificatif;

        return $this;
    }

    public function getIdfraisforfait(): ?Fraisforfait
    {
        return $this->idfraisforfait;
    }

    public function setIdfraisforfait(?Fraisforfait $idfraisforfait): self
    {
        $this->idfraisforfait = $idfraisforfait;

        return $this;
    }

    public function getIdvisiteur(): ?Visiteur
    {
        return $this->idvisiteur;
    }

    public function setIdvisiteur(?Visiteur $idvisiteur): self
    {
        $this->idvisiteur = $idvisiteur;

        return $this;
    }


}
