<?php

namespace Vendor\ShopBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('vendor_shop');

        $rootNode
            ->children()
                ->scalarNode('upload_path')
                    ->info('Path to the folder where files are uploaded (from the root of the project).')
                    ->example('/web/upload/')
                    ->isRequired()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
