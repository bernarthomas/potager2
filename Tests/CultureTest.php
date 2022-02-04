<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Tests fonctionnels CRUD nomenclature Cultures
 */
class CultureTest extends WebTestCase
{
    /**
     * Page liste des cultures
     *
     * @return void
     */
    public function testAffichagePageListeCultures()
    {
        $client = static::createClient();
        $routeur = $client->getContainer()->get('router');
        $client->request('GET', $routeur->generate('liste_cultures'));
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    /**
     * Formulaire ajouter une culture
     *
     * @return void
     */
    public function testAffichageFormulaireAjouterCulture()
    {
        $client = static::createClient();
        $routeur = $client->getContainer()->get('router');
        $navigateurDOM = $client->request('GET', $routeur->generate('liste_cultures'));
        $this->assertResponseIsSuccessful();
        $formulaire = $navigateurDOM->filter('form')->form(
            ['libelle' => 'carotte']
        );
        $client->submit($formulaire);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
