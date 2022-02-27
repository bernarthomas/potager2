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
 * Crud de la nomenclature des cultures
 */
class AjouteCultureController
{
    use TemplateTrait;

    /**
     * Formulaire d'ajout d'un culture
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
        RouterInterface $router,
    ): Response {
        try {
            $helper
                ->creeActionAjoute()
                ->enregistreActionAjoute();
        } catch (PotagerException $e) {
            $httpRequest->getSession()->getFlashBag()->add('warning', $e->getMessage());
        } finally {

            return new RedirectResponse($router->generate('liste_cultures'));
        }
    }
}
