<?php

namespace App\Out;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Bt\Port\Templating\TemplateInterface;

/**
 * Branche Twig à partir sur le port correspondant
 */
class TwigTemplate implements TemplateInterface
{
    /**
     * @inheritDoc
     */
    public function render(string $nomFichier, array $parametres = []): string
    {
        $loader = new FilesystemLoader(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'templates');
        $twig = new Environment($loader, [
            'cache' => dirname(__DIR__, 2) . DIRECTORY_SEPARATOR .'var/cache/' . DIRECTORY_SEPARATOR . 'dev'
        ]);
        return $twig->render($nomFichier, $parametres);
    }
}