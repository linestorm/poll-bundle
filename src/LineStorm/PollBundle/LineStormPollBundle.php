<?php

namespace LineStorm\PollBundle;

use LineStorm\BlogPostBundle\DependencyInjection\ContainerBuilder\ComponentCompilerPass;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use LineStorm\BlogBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass as LocalDoctrineOrmMappingsPass;
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

        $ormCompilerClass = 'Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass';
        $localOrmCompilerClass = 'LineStorm\BlogBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass';
        if (class_exists($ormCompilerClass)) {
            $container->addCompilerPass(
                DoctrineOrmMappingsPass::createXmlMappingDriver(
                    $mappings,
                    array('linestorm_blog.entity_manager'),
                    'linestorm_blog.backend_type_orm'
                ));
        } elseif (class_exists($localOrmCompilerClass)) {
            $container->addCompilerPass(
                LocalDoctrineOrmMappingsPass::createXmlMappingDriver(
                    $mappings,
                    array('linestorm_blog.entity_manager'),
                    'linestorm_blog.backend_type_orm'
                ));
        } else {
            throw new \Exception("Unable to find ORM mapper");
        }
    }
}
