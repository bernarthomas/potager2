<?php
namespace App\Controller;

use Bt\Port\Templating\TemplateInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Crud de la nomenclature des cultures
 */
class CultureController
{
    /**
     * Moteur de template
     * 
     * @var TemplateInterface
     */
    private TemplateInterface $template;

    /**
     * @param TemplateInterface $template
     */
    public function __construct(TemplateInterface $template)
    {
        $this->template = $template;
    }

    /**
     * Affiche la liste des occurences
     * 
     * @return Response
     */
    public function liste(): Response
    {
        return new Response($this->template->render('culture/liste.html.twig', ['contenu' => 'Nomenclature des cultures']));
    }
}
