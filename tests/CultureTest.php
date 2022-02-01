<?php
namespace App\Tests;

use \Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CultureTest extends WebTestCase
{
    public function testAffichagePageListeCultures()
    {
        $client = static::createClient();
        $response = $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
