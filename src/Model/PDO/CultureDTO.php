<?php

namespace App\Model\PDO;

use Bt\Culture\GestionnaireCultureInterface;
use PDO as _PDO;

class CultureDTO  extends _PDO implements GestionnaireCultureInterface
{
    private string $id;
    /**
     * @var string
     */
    private string $libelle;

    public function __construct()
    {
        parent::__construct('sqlite:'.dirname(__DIR__, 3).'/var/potager2.sqlite');
    }

    /**
     * @inheritDoc
     */
    public function ajoute(): bool
    {
        return self
            ::prepare("INSERT INTO _n_culture (libelle) VALUES (:libelle)")
            ->execute(['libelle' => $this->libelle])
            ;
    }

    /**
     * @inheritDoc
     */
    public function enleve(): bool
    {
        // TODO: Implement enleve() method.
    }

    /**
     * @inheritDoc
     */
    public function modifie(): bool
    {
        // TODO: Implement modifie() method.
    }

    /**
     * @inheritDoc
     */
    public function collecte(): array
    {
        return self
                ::query("SELECT * FROM  _n_culture ORDER BY libelle")
                ->fetchAll(self::FETCH_CLASS, CultureDTO::class)
            ?? []
            ;
    }

    /**
     * Accesseur Libellé
     *
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * Mutateur modification libellé
     *
     * @param string $libelle Libellé
     */
    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }
}