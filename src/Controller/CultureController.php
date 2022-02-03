<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * Crud de la nomenclature des cultures
 */
class CultureController
{
    use \App\Trait\TemplateTrait;
    /**
     * Affiche la liste des occurences
     * 
     * @return Response
     */
    public function liste(): Response
    {
        return new Response($this->template->render('culture/liste.html.twig', ['contenu' => 'Nomenclature des cultures2']));
    }
}
