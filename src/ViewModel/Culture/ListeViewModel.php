<?php

namespace App\ViewModel\Culture;

use App\Contrats\VueInterface;

/**
 * Objet passé à la vue pour fournir tous ses variables
 */
class ListeViewModel implements VueInterface
{
    /**
     * @var string
     */
    private string $jeton;

    /**
     * @var
     */
    private $flashMessages;

    /**
     * @var string
     */
    private string $libelle;

    /**
     * @var array
     */
    private array $occurences;

    /**
     * @param string $jeton
     */
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
     * @return string
     */
    public function getToken(): string
    {
        return $this->jeton;
    }

    /**
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     *
     * @return ListeViewModel
     */
    public function setLibelle(string $libelle): ListeViewModel
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return array
     */
    public function getOccurences(): array
    {
        return $this->occurences;
    }

    /**
     * @param array $occurences
     * @return ListeViewModel
     */
    public function setOccurences(array $occurences): ListeViewModel
    {
        $this->occurences = $occurences;
        return $this;
    }

    /**
     * @param array $messages
     *
     * @return ListeViewModel
     */
    public function setFlashMessages(array $messages): self
    {
        $this->flashMessages = $messages;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFlashMessages(): array
    {
        return $this->flashMessages;
    }

    public function setJeton(string $jeton): VueInterface
    {
        $this->jeton = $jeton;

        return $this;
    }
}
