<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class CultureController
{
    public function liste()
    {
        return new Response('Nomenclature des cultures');
    }
}