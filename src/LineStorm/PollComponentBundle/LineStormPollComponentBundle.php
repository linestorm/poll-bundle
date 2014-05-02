<?php

namespace LineStorm\PollComponentBundle;

use LineStorm\CmsBundle\DependencyInjection\ContainerBuilder\DoctrineOrmCompilerPass;
use LineStorm\PostBundle\DependencyInjection\ContainerBuilder\ComponentCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class LineStormPollComponentBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $modelDir = realpath(__DIR__.'/Resources/config/model/doctrine');
        $mappings = array(
            $modelDir => 'LineStorm\PollComponentBundle\Model',
        );
        $container->addCompilerPass(DoctrineOrmCompilerPass::getMappingsPass($mappings));
    }
}
