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
     * Classe du kernel
     *
     * @return string
     */
    protected static function getKernelClass(): string
    {
        return '\App\Kernel';
    }
}
