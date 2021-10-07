<?php

namespace App\Entity;

use App\Repository\InformationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InformationRepository::class)
 */
class Information
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $btnFacebook;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $btnInstagram;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $btnTwitter;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstIllustration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secondIllustration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstDay;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastDay;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $openHour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $closeHour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $btnTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $btnUrl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameLink;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBtnFacebook(): ?string
    {
        return $this->btnFacebook;
    }

    public function setBtnFacebook(string $btnFacebook): self
    {
        $this->btnFacebook = $btnFacebook;

        return $this;
    }

    public function getBtnInstagram(): ?string
    {
        return $this->btnInstagram;
    }

    public function setBtnInstagram(string $btnInstagram): self
    {
        $this->btnInstagram = $btnInstagram;

        return $this;
    }

    public function getBtnTwitter(): ?string
    {
        return $this->btnTwitter;
    }

    public function setBtnTwitter(string $btnTwitter): self
    {
        $this->btnTwitter = $btnTwitter;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFirstIllustration(): ?string
    {
        return $this->firstIllustration;
    }

    public function setFirstIllustration(string $firstIllustration): self
    {
        $this->firstIllustration = $firstIllustration;

        return $this;
    }

    public function getSecondIllustration(): ?string
    {
        return $this->secondIllustration;
    }

    public function setSecondIllustration(string $secondIllustration): self
    {
        $this->secondIllustration = $secondIllustration;

        return $this;
    }

    public function getFirstDay(): ?string
    {
        return $this->firstDay;
    }

    public function setFirstDay(string $firstDay): self
    {
        $this->firstDay = $firstDay;

        return $this;
    }

    public function getLastDay(): ?string
    {
        return $this->lastDay;
    }

    public function setLastDay(string $lastDay): self
    {
        $this->lastDay = $lastDay;

        return $this;
    }

    public function getOpenHour(): ?string
    {
        return $this->openHour;
    }

    public function setOpenHour(string $openHour): self
    {
        $this->openHour = $openHour;

        return $this;
    }

    public function getCloseHour(): ?string
    {
        return $this->closeHour;
    }

    public function setCloseHour(string $closeHour): self
    {
        $this->closeHour = $closeHour;

        return $this;
    }

    public function getBtnTitle(): ?string
    {
        return $this->btnTitle;
    }

    public function setBtnTitle(string $btnTitle): self
    {
        $this->btnTitle = $btnTitle;

        return $this;
    }

    public function getBtnUrl(): ?string
    {
        return $this->btnUrl;
    }

    public function setBtnUrl(string $btnUrl): self
    {
        $this->btnUrl = $btnUrl;

        return $this;
    }

    public function getNameLink(): ?string
    {
        return $this->nameLink;
    }

    public function setNameLink(string $nameLink): self
    {
        $this->nameLink = $nameLink;

        return $this;
    }
}
