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
     * Ajouter une culture
     *
     * @param CultureHelper $helper
     * @param Request $httpRequest
     *
     * @return Response
     */
    public function liste(CultureHelper $helper, Request $httpRequest): Response
    {
        $helper
            ->genereJetonCsrf()
            ->initialiseDonnees()
        ;
        if ('POST' === $httpRequest->getMethod()) {
            $helper
                ->instancieCulture()
                ->ajouteOccurence()
                ->metAJourViewModel()
                ;
        }

        return new Response($this->template->render('culture/liste.html.twig', $helper->getViewModel()->toArray()));
    }
}
