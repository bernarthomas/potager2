<?php

namespace App\Contrats;

/**
 * Contrat pour les Vues
 */
interface VueInterface
{
    /**
     * Formate les données en tableau
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * @param array $messages
     *
     * @return $this
     */
    public function setFlashMessages(array $messages): self;

    /**
     * @param string $jeton
     *
     * @return $this
     */
    public function setJeton(string $jeton): self;
}