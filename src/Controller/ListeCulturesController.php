<?php
namespace App\Controller;

use App\Service\Controller\CultureHelper;
use Symfony\Component\HttpFoundation\Response;
use App\Trait\TemplateTrait;

/**
 * Admin de la nomenclature des cultures
 */
class ListeCulturesController
{
    use TemplateTrait;

    /**
     * Liste des cultures avec possibilité d'ajout
     *
     * @param CultureHelper $helper
     *
     * @return Response
     */
    public function traitement(
        CultureHelper $helper
    ): Response {
        $helper
            ->collecteListeCultures()
            ->peupleVue()
        ;

        return new Response($this->template->render('culture/liste.html.twig', $helper->getVue()->toArray()));
    }
}
