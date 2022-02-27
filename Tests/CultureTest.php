<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use DateTime;

/**
 * Tests fonctionnels CRUD nomenclature Cultures
 */
class CultureTest extends WebTestCase
{
    /**
     * @var KernelBrowser
     */
    private KernelBrowser $client;
    /**
     * @var object|null
     */
    private ?object $routeur;

    /**
     * @return void
     */
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
        $formulaire['libelle']->setValue(md5((new DateTime())->format('dmYhis')));
        $retourPost = $this->client->submit($formulaire);
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $this->assertSame(0, $retourPost->filter('html:contains("une culture doit être unique.")')->count());
    }
}
