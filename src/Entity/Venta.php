<?php

namespace App\Entity;

use App\Repository\VentaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VentaRepository::class)
 */
class Venta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $codigo;

    /**
     * @ORM\Column(type="integer")
     */
    private $total;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaVenta;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $formaPago;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cuotas;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $estado;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $entrego;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $observaciones;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?int
    {
        return $this->codigo;
    }

    public function setCodigo(?int $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFechaVenta(): ?\DateTimeInterface
    {
        return $this->fechaVenta;
    }

    public function setFechaVenta(?\DateTimeInterface $fechaVenta): self
    {
        $this->fechaVenta = $fechaVenta;

        return $this;
    }

    public function getFormaPago(): ?string
    {
        return $this->formaPago;
    }

    public function setFormaPago(?string $formaPago): self
    {
        $this->formaPago = $formaPago;

        return $this;
    }

    public function getCuotas(): ?int
    {
        return $this->cuotas;
    }

    public function setCuotas(?int $cuotas): self
    {
        $this->cuotas = $cuotas;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getEntrego(): ?int
    {
        return $this->entrego;
    }

    public function setEntrego(?int $entrego): self
    {
        $this->entrego = $entrego;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }
}
