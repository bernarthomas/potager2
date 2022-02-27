<?php

namespace App\Model\PDO;

use Bt\Culture\Culture as CultureMetier;
use Bt\Culture\ExceptionLibelleUnique;
use Bt\Culture\ExceptionLibelleVide;
use Bt\Culture\GestionnaireInterface;
use PDO;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Object métier culture avec actions pour persistance et accesseurs et mutateurs
 */
class Culture  extends PDO implements GestionnaireInterface
{
    /**
     * Identifiant unique Culture
     *
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $libelle;

    /**
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(ParameterBagInterface $parameterBag)
    {
        parent::__construct($parameterBag->get('data_dsn'));
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
    public function supprime(): bool
    {
        return self
            ::prepare("DELETE FROM _n_culture WHERE id = :id")
            ->execute(['id' => $this->id])
            ;
    }

    /**
     * @inheritDoc
     */
    public function modifie(): bool
    {
        // TODO: Implement modifie() method.
    }

    /**
     * @return array
     *
     * @throws ExceptionLibelleUnique
     * @throws ExceptionLibelleVide
     */
    public function collecte(): array
    {
        $stmt = self::prepare("SELECT * FROM  _n_culture ORDER BY libelle");
        $stmt->execute();
        $resultat = $stmt->fetchAll(self::FETCH_ASSOC);
        $retour = [];
        if (!empty($resultat)) {
            foreach ($resultat as $item) {
                $retour[] = new CultureMetier($item['id'], $item['libelle'], $this);
            }
        }

        return $retour;
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
}
