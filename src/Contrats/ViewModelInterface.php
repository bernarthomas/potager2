<?php

namespace App\Contrats;

/**
 * Contrat pour les ViewModel
 */
interface ViewModelInterface
{
    /**
     * Formate les données en tableau
     *
     * @return array
     */
    public function toArray(): array;
}