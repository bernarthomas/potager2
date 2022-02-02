<?php
namespace App\Tests;

use \Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;

class CultureTest extends WebTestCase
{
    public function testAffichagePageListeCultures()
    {
        $client = static::createClient();
        $client->request('GET', 'http://potager2/cultures');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    protected static function getKernelClass(): string
    {
        return '\App\Kernel';
    }
}
