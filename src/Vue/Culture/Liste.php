<?php

namespace App\Vue\Culture;

use App\Contrats\VueInterface;

/**
 * Objet passé à la vue pour fournir toutes ses variables
 */
class Liste implements VueInterface
{
    /**
     * @var string
     */
    private string $jeton;

    /**
     * Messages affichés pour l'utilisateur
     *
     * @var array
     */
    private array $flashMessages;

    /**
     * @var string
     */
    private string $libelle;

    /**
     * @var array
     */
    private array $occurences;

    public function __construct()
    {
        $this->jeton = '';
        $this->flashMessages = [];
        $this->libelle = '';
        $this->occurences = [];
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'jeton' => $this->jeton,
            'flashMessages' => $this->flashMessages,
            'libelle' => $this->libelle,
            'occurences' => $this->occurences
        ];
    }

    /**
     * Accesseur jetonde sécurité
     *
     * @return string
     */
    public function getJeton(): string
    {
        return $this->jeton;
    }

    /**
     * Mutateur jeton de sécurité
     *
     * @param string $jeton
     *
     * @return VueInterface
     */
    public function setJeton(string $jeton): VueInterface
    {
        $this->jeton = $jeton;

        return $this;
    }

    /**
     * Accesseur libellé culture
     *
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * Mutateur libellé culture
     *
     * @param string $libelle
     *
     * @return Liste
     */
    public function setLibelle(string $libelle): Liste
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Accesseur cultures stockees
     *
     * @return array
     */
    public function getOccurences(): array
    {
        return $this->occurences;
    }

    /**
     * Mutateur cultures stockees
     *
     * @param array $occurences
     *
     * @return Liste
     */
    public function setOccurences(array $occurences): Liste
    {
        $this->occurences = $occurences;

        return $this;
    }

    /**
     * Mutateur messages alerte utilisateur
     *
     * @param array $messages
     *
     * @return Liste
     */
    public function setFlashMessages(array $messages): self
    {
        $this->flashMessages = $messages;

        return $this;
    }

    /**
     * Accesseur messages alerte utilisateur
     *
     * @return mixed
     */
    public function getFlashMessages(): array
    {
        return $this->flashMessages;
    }
}
