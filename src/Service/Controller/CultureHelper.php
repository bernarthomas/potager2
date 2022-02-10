<?php

namespace App\Service\Controller;

use App\Contrats\ViewModelInterface;
use App\Model\PDO\CulturePDO;
use App\ViewModel\Culture\ListeViewModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManager;

/**
 * Service Symfony responsable de la nomenclature des cultures
 */
class CultureHelper
{
    /**
     * @var CulturePDO
     */
    private CulturePDO $culture;

    /**
     * @var ViewModelInterface
     */
    private ViewModelInterface $viewModel;

    /**
     * @var CsrfToken
     */
    private CsrfToken $jeton;

    /**
     * @var Request|null
     */
    private Request $request;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->donnees = [];
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * @return $this
     */
    public function genereJetonCsrf()
    {
        $this->jeton = (new CsrfTokenManager())->refreshToken('liste_cultures');

        return $this;
    }

    /**
     * @return $this
     */
    public function initialiseDonnees()
    {
        $this->viewModel = (new ListeViewModel($this->jeton));

        return $this;
    }

    /**
     * @return $this
     */
    public function instancieCulture()
    {
        $this->culture = new CulturePDO();
        $this->culture
            ->setDonnees($this->request->request->all())
            ->hydrate();

        return $this;
    }

    /**
     * @return $this
     */
    public function ajouteOccurence()
    {
        $this->culture->ajoute();

        return $this;
    }

    /**
     * @return void
     */
    public function metAJourViewModel()
    {
        $this->viewModel->libelle = $this->request->request->get('libelle');
    }

    /**
     * @return ViewModelInterface
     */
    public function getViewModel(): ViewModelInterface
    {
        return $this->viewModel;
    }
}
