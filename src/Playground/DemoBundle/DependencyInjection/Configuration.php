<?php

namespace Playground\DemoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('playground_demo');

        $rootNode
            ->children()
                ->integerNode('open_day')
                    ->info('Opening day of the website, from 0 for sunday to 6 for saturday')
                    ->example('0')
                    ->isRequired()
                    ->min(0)
                    ->max(6)
                ->end()
                ->integerNode('close_day')
                    ->info('Closing day of the website, from 0 for sunday to 6 for saturday')
                    ->example('5')
                    ->isRequired()
                    ->min(0)
                    ->max(6)
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
