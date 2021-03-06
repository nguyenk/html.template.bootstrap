<?php


namespace Mouf\Html\Template;

use Mouf\Html\HtmlElement\HtmlBlock;
use Mouf\Html\Renderer\CanSetTemplateRendererInterface;
use Mouf\Html\Renderer\FileBasedRenderer;
use Mouf\Html\Utils\WebLibraryManager\WebLibraryManager;
use Psr\Container\ContainerInterface;
use Psr\SimpleCache\CacheInterface;
use TheCodingMachine\Funky\Annotations\Factory;
use TheCodingMachine\Funky\ServiceProvider;
use Mouf\Html\Template\TemplateInterface;

class BootstrapTemplateServiceProvider extends ServiceProvider
{
    /**
     * @Factory(aliases={"block.content"})
     */
    public function createBlockContent(): HtmlBlock
    {
        return new HtmlBlock();
    }

    /**
     * @Factory(name="block.left")
     */
    public function createBlockLeft(): HtmlBlock
    {
        return new HtmlBlock();
    }

    /**
     * @Factory(name="block.right")
     */
    public function createBlockRight(): HtmlBlock
    {
        return new HtmlBlock();
    }

    /**
     * @Factory(name="block.header")
     */
    public function createBlockHeader(): HtmlBlock
    {
        return new HtmlBlock();
    }

    /**
     * @Factory(name="block.footer")
     */
    public function createBlockFooter(): HtmlBlock
    {
        return new HtmlBlock();
    }

    /**
     * @Factory(aliases={TemplateInterface::class})
     */
    public function createBootstrapTemplate(CanSetTemplateRendererInterface $templateRenderer, ContainerInterface $container, WebLibraryManager $webLibraryManager): BootstrapTemplate
    {
        $bootstrapTemplate = new BootstrapTemplate($templateRenderer, "bootstrapTemplateRenderer");
        $bootstrapTemplate->setContent($container->get('block.content'));
        $bootstrapTemplate->setHeader($container->get('block.header'));
        $bootstrapTemplate->setFooter($container->get('block.footer'));
        $bootstrapTemplate->setLeft($container->get('block.left'));
        $bootstrapTemplate->setRight($container->get('block.right'));
        $bootstrapTemplate->setWebLibraryManager($webLibraryManager);
        return $bootstrapTemplate;
    }

    /**
     * @Factory(name="bootstrapTemplateRenderer")
     */
    public function createTemplateRenderer(CacheInterface $cache, ContainerInterface $container, \Twig_Environment $twig): FileBasedRenderer
    {
        return new FileBasedRenderer(__DIR__.'/../../../templates/', $cache, $container, $twig);
    }
}
