<?php

namespace LineStorm\PollBundle;

use LineStorm\CmsBundle\DependencyInjection\ContainerBuilder\DoctrineOrmCompilerPass;
use LineStorm\PostBundle\DependencyInjection\ContainerBuilder\ComponentCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class LineStormPollBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ComponentCompilerPass());

        $modelDir = realpath(__DIR__.'/Resources/config/model/doctrine');
        $mappings = array(
            $modelDir => 'LineStorm\PollBundle\Model',
        );
        $container->addCompilerPass(DoctrineOrmCompilerPass::getMappingsPass($mappings));
    }
}
