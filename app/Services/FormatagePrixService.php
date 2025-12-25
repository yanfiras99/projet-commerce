<?php

namespace App\Services;

class FormatagePrixService
{
    protected string $devise;
    protected float $TVA;

    public function __construct(string $devise = 'TND', float $TVA = 0.19)
    {
        $this->devise = $devise;
        $this->TVA = $TVA;
    }

    public function formatNet(float $montant): string
    {
        return number_format($montant, 2, ',', ' ') . ' ' . $this->devise;
    }

    public function formatAvecTVA(float $montant): string
    {
        $prixTTC = $montant * (1 + $this->TVA);
        return number_format($prixTTC, 2, ',', ' ') . ' ' . $this->devise;
    }
}
