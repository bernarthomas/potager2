<?php

namespace App\ViewModel\Culture;

use App\Contrats\ViewModelInterface;

/**
 * Objet passé à la vue pour fournir tous ses variables
 */
class ListeViewModel implements ViewModelInterface
{
    /**
     * @var string
     */
    public string $_token;

    /**
     * @var string
     */
    public string $libelle;

    /**
     * @var array
     */
    public array $occurences;

    /**
     * @param string $_token
     */
    public function __construct()
    {
        $this->_token = '';
        $this->libelle = '';
        $this->occurences = [];
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return ['_token' => $this->_token, 'libelle' => $this->libelle, 'occurences' => $this->occurences];
    }
}
