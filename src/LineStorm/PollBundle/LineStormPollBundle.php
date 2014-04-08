<?php

namespace LineStorm\PollBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use LineStorm\CmsBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass as LocalDoctrineOrmMappingsPass;
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

        $ormCompilerClass = 'Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass';
        $localOrmCompilerClass = 'LineStorm\CmsBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass';
        if (class_exists($ormCompilerClass)) {
            $container->addCompilerPass(
                DoctrineOrmMappingsPass::createXmlMappingDriver(
                    $mappings,
                    array('linestorm_cms.entity_manager'),
                    'linestorm_cms.backend_type_orm'
                ));
        } elseif (class_exists($localOrmCompilerClass)) {
            $container->addCompilerPass(
                LocalDoctrineOrmMappingsPass::createXmlMappingDriver(
                    $mappings,
                    array('linestorm_cms.entity_manager'),
                    'linestorm_cms.backend_type_orm'
                ));
        } else {
            throw new \Exception("Unable to find ORM mapper");
        }
    }
}
