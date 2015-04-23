<?php

namespace Behat\PhantomJsExtension\ServiceContainer;

use Behat\PhantomJsExtension\ServiceContainer\Driver\PhantomJsFactory;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Behat\Testwork\ServiceContainer\Extension as ExtensionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class PhantomJsExtension implements ExtensionInterface
{
    public function getConfigKey()
    {
        return 'phantomjs';
    }

    public function initialize(ExtensionManager $extensionManager)
    {
        if (null !== $minkExtension = $extensionManager->getExtension('mink')) {
            $minkExtension->registerDriverFactory(new PhantomJsFactory());
        }
    }

    public function load(ContainerBuilder $container, array $config)
    {
        // do nothing
    }

    public function configure(ArrayNodeDefinition $builder)
    {
        // do nothing
    }

    public function process(ContainerBuilder $container)
    {
        // do nothing
    }
}