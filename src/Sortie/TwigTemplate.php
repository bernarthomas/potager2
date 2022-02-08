<?php

namespace App\Sortie;

use Bt\Port\Templating\ViewModelInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Bt\Port\Templating\TemplateInterface;

/**
 * Branche Twig sur le port correspondant
 */
class TwigTemplate implements TemplateInterface
{
    /**
     * @var ContainerBagInterface
     */
    private ContainerBagInterface $parametres;

    /**
     * @param ContainerBagInterface $parametres
     */
    public function __construct(ContainerBagInterface $parametres)
    {
        $this->parametres = $parametres;
    }

    /**
     * @inheritDoc
     */
    public function render(string $nomFichier, array $parametres = []): string
    {
        $loader = new FilesystemLoader(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'templates');
        $twig = new Environment($loader, [
            'cache' => dirname(__DIR__, 2)
                . DIRECTORY_SEPARATOR .'var/cache/' . DIRECTORY_SEPARATOR . $this->parametres->get('app_env')
        ]);

        return $twig->render($nomFichier, $parametres);
    }
}
