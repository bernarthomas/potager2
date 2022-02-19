<?php

namespace App\Service\Controller;

use App\Contrats\VueInterface;
use Bt\Culture\AjouteCultureAction;
use Bt\Culture\Culture;
use Bt\Culture\GestionnaireCultureInterface;
use Bt\Culture\ListeCultures;
use Bt\Exception\PotagerException;
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
     * @var AjouteCultureAction
     */
    private AjouteCultureAction $ajouteCultureAction;

    /**
     * @var Culture
     */
    private Culture $cultureAAjouter;

    /**
     * @var CsrfToken
     */
    private CsrfToken $jeton;

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
     * @var GestionnaireCultureInterface
     */
    private GestionnaireCultureInterface $gestionnaireCulture;

    /**
     * @param CsrfTokenManagerInterface $gestionnaireJeton
     * @param RequestStack $requestStack
     * @param VueInterface $vue
     * @param GestionnaireCultureInterface $gestionnaireCulture
     * @param Culture $cultureAAjouter
     * @param ListeCultures $listeCultures
     */
    public function __construct(
        CsrfTokenManagerInterface $gestionnaireJeton,
        RequestStack $requestStack,
        VueInterface $vue,
        GestionnaireCultureInterface $gestionnaireCulture,
        Culture $cultureAAjouter,
        ListeCultures $listeCultures
    ) {
        $this->requeteHttp = $requestStack->getCurrentRequest();
        $this->session = $this->requeteHttp->getSession();
        $this->vue = $vue;
        $this->gestionnaireJeton = $gestionnaireJeton;
        $this->gestionnaireCulture = $gestionnaireCulture;
        $this->jeton = $this->gestionnaireJeton->refreshToken('liste_cultures');
        $this->cultureAAjouter = $cultureAAjouter;
        $this->listeCultures = $listeCultures;
    }

    /**
     * @return $this
     */
    public function instancieCultureAAjouterAvecGestionErreurs(): CultureHelper
    {
        try {
            $this->cultureAAjouter = new Culture($this->requeteHttp->request->get('libelle'), $this->gestionnaireCulture->collecte());
        } catch (PotagerException $e) {
            $this->session->getFlashBag()->add('warning', $e->getMessage());
        } finally {
            return $this;
        }
    }

    /**
     * @return $this
     */
    public function instancieAjoutCultureAction(): CultureHelper
    {
        $this->ajouteCultureAction = new AjouteCultureAction($this->gestionnaireCulture, $this->cultureAAjouter);

        return $this;
    }

    /**
     * @return $this
     */
    public function enregistreAjoutCultureAction(): CultureHelper
    {
        $this->ajouteCultureAction->enregistre();

        return $this;
    }

    /**
     * @return $this
     */
    public function instancieListeCultures(): CultureHelper
    {
        try {
            $this->listeCultures = new ListeCultures($this->gestionnaireCulture->collecte());
        } catch (PotagerException $e) {
            $this->session->getFlashBag()->add('warning', $e->getMessage());
        } finally {

            return $this;
        }
    }

    /**
     * @return $this
     */
    public function peupleVue(): CultureHelper
    {
        $this->vue
            ->setJeton($this->jeton)
            ->setOccurences($this->listeCultures->getOccurences())
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
