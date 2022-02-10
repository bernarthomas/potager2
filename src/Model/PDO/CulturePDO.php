<?php
namespace App\Model\PDO;

use Bt\Model\CultureInterface;
use PDO as _PDO;

/**
 * Classe responsable de la maintenance des cultures
 */
class CulturePDO extends _PDO implements CultureInterface
{
    /**
     * @var array
     */
    public array $donnees;
    /**
     * @var int
     */
    public int $id;
    /**
     * @var string
     */
    public string $libelle;

    /**
     *
     */
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
    public function collecte(): array
    {
        return self
            ::query("SELECT * FROM  _n_culture ORDER BY libelle")
            ->fetchAll(self::FETCH_CLASS, CulturePDO::class)
            ?? []
            ;
    }

    /**
     * @return bool
     */
    public function hydrate(): bool
    {
        $this->libelle = $this->donnees['libelle'];

        return true;
    }

    /**
     * @inheritDoc
     */
    public function valide(): bool
    {
        // TODO: Implement valide() method.

        return true;
    }

    /**
     * @param mixed $donnees
     *
     * @return CulturePDO
     */
    public function setDonnees($donnees): self
    {
        $this->donnees = $donnees;

        return $this;
    }
}
