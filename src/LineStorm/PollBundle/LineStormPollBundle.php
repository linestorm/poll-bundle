<?php

namespace LineStorm\PollBundle;

use LineStorm\BlogPostBundle\DependencyInjection\ContainerBuilder\ComponentCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class LineStormPollBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ComponentCompilerPass());
    }
}
