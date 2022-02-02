<?php
namespace App\Tests;

use \Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CultureTest extends WebTestCase
{
    public function testAffichagePageListeCultures()
    {
        $client = static::createClient();
        $routeur = $client->getContainer()->get('router');
        $client->request('GET', $routeur->generate('liste_cultures'));
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    protected static function getKernelClass(): string
    {
        return '\App\Kernel';
    }
}
