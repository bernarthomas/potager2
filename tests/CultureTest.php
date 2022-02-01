<?php

use  Symfony\Component\HttpClient\NativeHttpClient;
use Symfony\Component\HttpFoundation\Response;

class CultureTest extends \PHPUnit\Framework\TestCase
{
    public function testAffichagePageListeCultures()
    {
        $clientHttp = new NativeHttpClient();
        $response = $clientHttp->request('GET','http://potager2/cultures/liste');
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}