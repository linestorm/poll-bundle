<?php

namespace LineStorm\PollBundle\Module\Post\Component;

use LineStorm\BlogBundle\Module\Post\Component\AbstractHeaderComponent;
use LineStorm\BlogBundle\Module\Post\Component\ComponentInterface;

class PollComponent extends AbstractHeaderComponent implements ComponentInterface
{
    protected $name = 'Poll';
    protected $id = 'poll';

    public function isSupported($entity)
    {
        return ($entity instanceof Tag);
    }

    /**
     * @param $entity Tag
     * @return string
     */
    public function getViewTemplate($entity)
    {
        return '';
    }

    public function getNewTemplate()
    {
        $tags = $this->modelManager->get('tag')->findBy(array(), array('name' => 'ASC'));

        return $this->templating->render('LineStormBlogBundle:Modules:Post/Component/tag/new.html.twig', array(
            'tagEntities'   => null,
            'component'     => $this,
            'tags'          => $tags,
        ));
    }

    /**
     * @param $entity Tag
     * @return string
     */
    public function getEditTemplate($entity)
    {
        $tags = $this->modelManager->get('tag')->findBy(array(), array('name' => 'ASC'));

        return $this->templating->render('LineStormBlogBundle:Modules:Post/Component/tag/new.html.twig', array(
            'tagEntities'   => $entity,
            'component'     => $this,
            'tags'          => $tags,
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tags', 'tag', array(
                'em' => $this->modelManager->getManager(),
                'tag_class' => $this->modelManager->getEntityClass('tag'),
                'name'  => 'name',
            ))
        ;
    }


    public function handleSave(Post $post, array $data)
    {
        $entities = array();

        foreach ($data as $eData) {
            $tag = $this->getEntityByName($eData);
            if (!($tag instanceof Tag)) {
                $tag = $this->createEntity($eData);
            }
            $post->addTag($tag);
            $entities[] = $tag;
        }

        return $entities;
    }

    public function getEntityByName(array $data)
    {
        return $this->modelManager->get('tag')->findOneBy(array(
            'name' => $data['name']
        ));
    }

    public function createEntity(array $data)
    {
        $class  = $this->modelManager->getEntityClass('tag');
        $entity = new $class();

        $entity->setName($data['name']);

        return $entity;
    }

    public function getRoutes(LoaderInterface $loader)
    {
        return null;
    }
} 
