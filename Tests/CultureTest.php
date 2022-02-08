<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Tests fonctionnels CRUD nomenclature Cultures
 */
class CultureTest extends WebTestCase
{
    private $client;
    private $routeur;
    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->routeur = $this->client->getContainer()->get('router');
    }

    /**
     * Formulaire ajouter une culture
     *
     * @return void
     */
    public function testFormulaireAjouterCulture()
    {
        $retourGet = $this->client->request('GET', $this->routeur->generate('liste_cultures'));
        $this->assertSelectorTextContains('fieldset legend', 'Ajouter une culture');
        $this->assertSelectorTextContains('h1', 'Nomenclature des cultures');
        $this->assertResponseIsSuccessful();
        $formulaire = $retourGet->filter('#formulaire-ajouter-culture')->form();
        $retourPost = $this->client->submit($formulaire, ['libelle' => 'carotte']);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertNotNull($retourPost->filter('#_token')->attr('value'));
        $this->assertNotNull($retourPost->filter('#libelle')->attr('value'));
    }
}
