<?php
namespace App\Controller;

use App\Service\Controller\CultureHelper;
use Bt\Exception\PotagerException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use App\Trait\TemplateTrait;

/**
 * Supprime une culture
 */
class SupprimeCultureController
{
    use TemplateTrait;

    /**
     * Liste des cultures avec possibilité d'ajout
     *
     * @param Request $httpRequest
     * @param CultureHelper $helper
     * @param RouterInterface $router
     *
     * @return Response
     */
    public function traitement(
        Request $httpRequest,
        CultureHelper $helper,
        RouterInterface $router
    ): Response {
        try {
            $helper
                ->creeActionSupprime()
                ->enregistreActionSupprime()
            ;
        } catch (PotagerException $e) {
            $httpRequest->getSession()->getFlashBag()->add('warning', $e->getMessage());
        } finally {

            return new RedirectResponse($router->generate('liste_cultures'));
        }
    }
}
