<?php
namespace App\Controller;

use App\Service\Controller\CultureHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Crud de la nomenclature des cultures
 */
class CultureController
{
    use \App\Trait\TemplateTrait;

    /**
     * Liste des cultures avec possibilité d'ajout
     *
     * @param Request $httpRequest
     * @param CultureHelper $helper
     *
     * @return Response
     */
    public function liste(
        Request $httpRequest,
        CultureHelper $helper
    ): Response {
        if ('POST' === $httpRequest->getMethod()) {
            $helper
                ->instancieCultureAAjouterAvecGestionErreurs()
                ->instancieAjoutCultureAction()
                ->enregistreAjoutCultureAction()
                ;
        }
        $helper
            ->instancieListeCultures()
            ->peupleVue()
            ;

        return new Response($this->template->render('culture/liste.html.twig', $helper->getVue()->toArray()));
    }
}
