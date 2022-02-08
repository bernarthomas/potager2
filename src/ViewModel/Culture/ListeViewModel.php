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
     * @param string $_token
     */
    public function __construct(string $_token)
    {
        $this->_token = $_token;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return ['_token' => $this->_token,];
    }
}
