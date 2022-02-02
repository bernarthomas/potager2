<?php
namespace App\Controller;

class CultureController
{
    public function liste()
    {
        return new \Symfony\Component\HttpFoundation\Response('Nomenclature des cultures');
    }
}