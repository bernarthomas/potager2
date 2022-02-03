<?php
namespace App\Trait;

use Bt\Port\Templating\TemplateInterface;

trait TemplateTrait
{
    /**
     * Moteur de template
     *
     * @var TemplateInterface
     */
    private TemplateInterface $template;

    /**
     * @param TemplateInterface $template
     */
    public function __construct(TemplateInterface $template)
    {
        $this->template = $template;
    }
}