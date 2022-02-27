<?php

namespace App\Service\Controller;

use App\Contrats\VueInterface;
use Bt\Culture\ActionAjoute;
use Bt\Culture\ActionListe;
use Bt\Culture\ActionSupprime;
use Bt\Culture\Culture;
use Bt\Culture\ExceptionLibelleUnique;
use Bt\Culture\ExceptionLibelleVide;
use Bt\Culture\GestionnaireInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

/**
 * Service Symfony responsable de la nomenclature des cultures
 */
class CultureHelper
{
    /**
     * @var ActionAjoute
     */
    private ActionAjoute $actionAjoute;

    /**
     * @var ActionListe
     */
    private ActionListe $actionListe;

    /**
     * @var ActionSupprime
     */
    private ActionSupprime $actionSupprime;

    /**
     * @var CsrfToken
     */
    private CsrfToken $jeton;

    /**
     * @var array
     */
    private array $listeCultures;

    /**
     * @var VueInterface Objet de données passées à la vue
     */
    private VueInterface $vue;

    /**
     * @var Request Occurence
     */
    private Request $requeteHttp;

    /**
     * @var SessionInterface Occurence
     */
    private SessionInterface $session;

    /**
     * @param CsrfTokenManagerInterface
     */
    private CsrfTokenManagerInterface $gestionnaireJeton;

    /**
     * @var GestionnaireInterface
     */
    private GestionnaireInterface $gestionnaire;

    /**
     * @param CsrfTokenManagerInterface $gestionnaireJeton
     * @param RequestStack $requestStack
     * @param VueInterface $vue
     * @param GestionnaireInterface $gestionnaire
     */
    public function __construct(
        CsrfTokenManagerInterface $gestionnaireJeton,
        RequestStack $requestStack,
        VueInterface $vue,
        GestionnaireInterface $gestionnaire
    ) {
        $this->requeteHttp = $requestStack->getCurrentRequest();
        $this->session = $this->requeteHttp->getSession();
        $this->vue = $vue;
        $this->gestionnaireJeton = $gestionnaireJeton;
        $this->gestionnaire = $gestionnaire;
        $this->jeton = $this->gestionnaireJeton->refreshToken('liste_cultures');
        $this->actionListe = new ActionListe($this->gestionnaire);
    }

    /**
     * @return $this
     *
     * @throws ExceptionLibelleUnique
     * @throws ExceptionLibelleVide
     */
    public function creeActionAjoute(): CultureHelper
    {
        $cultureAAjouter = new Culture(null, $this->requeteHttp->request->get('libelle'), $this->gestionnaire, true);
        $this->actionAjoute = new ActionAjoute($cultureAAjouter);

        return $this;
    }

    /**
     * @return $this
     */
    public function enregistreActionAjoute(): CultureHelper
    {
        $this->actionAjoute->execute();

        return $this;
    }

    /**
     * @return $this
     *
     * @throws ExceptionLibelleUnique
     * @throws ExceptionLibelleVide
     */
    public function creeActionSupprime(): CultureHelper
    {
        $cultureASupprimer = new Culture($this->requeteHttp->request->get('id'), '',  $this->gestionnaire);
        $this->actionSupprime = new ActionSupprime($cultureASupprimer);

        return $this;
    }

    /**
     * @return $this
     */
    public function enregistreActionSupprime(): CultureHelper
    {
        $this->actionSupprime->execute();

        return $this;
    }

    /**
     * @return $this
     */
    public function collecteListeCultures(): CultureHelper
    {
        $this->listeCultures = $this->actionListe->execute();

        return $this;
    }

    /**
     * @return $this
     */
    public function peupleVue(): CultureHelper
    {
        $this->vue
            ->setJeton($this->jeton)
            ->setOccurences($this->listeCultures)
            ->setFlashMessages($this->session->getFlashBag()->all())
        ;

        return $this;
    }

    /**
     * @return VueInterface
     */
    public function getVue(): VueInterface
    {
        return $this->vue;
    }
}
