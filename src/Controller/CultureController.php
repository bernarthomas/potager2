<?php
namespace App\Controller;


use App\Service\Controller\CultureHelper;
use Symfony\Component\HttpFoundation\Response;


/**
 * Crud de la nomenclature des cultures
 */
class CultureController
{
    use \App\Trait\TemplateTrait;

    /**
     * @param CultureHelper $helper
     * @return Response
     */
    public function liste(CultureHelper $helper): Response
    {
        return new Response($this->template->render('culture/liste.html.twig', ['contenu' => 'Nomenclature des cultures']));
    }
}
