<?php

namespace LineStorm\PollComponentBundle\Model\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class PollRepository extends EntityRepository
{

    public function findResults($id)
    {
        $hydration = Query::HYDRATE_ARRAY;
        // fetch the poll
        $class = $this->getEntityName();
        $dql = "
            SELECT
              p, o
            FROM
              {$class} p
              JOIN p.options o
            WHERE
              p.id = ?1
        ";
        $poll = $this
            ->getEntityManager()
            ->createQuery($dql)
            ->setParameter(1, $id)
            ->getSingleResult($hydration);

        // get the count of all the results
        $optionMapping = $this->_class->getAssociationMapping('options');
        $dql = "
            SELECT
              o.id as id, size(o.answers) as answer_count
            FROM
              {$optionMapping['targetEntity']} o
              JOIN o.poll p
            WHERE
              p.id = ?1
        ";

        $pollData = $this
            ->getEntityManager()
            ->createQuery($dql)
            ->setParameter(1, $poll['id'])
            ->getResult($hydration);

        $map = array();
        foreach($pollData as $result)
        {
            $map[$result['id']] = $result;
        }

        $poll['total'] = 0;
        foreach($poll['options'] as &$option)
        {
            $count = (int)$map[$option['id']]['answer_count'];
            $option['count'] = $count;
            $poll['total'] += $count;
        }

        return $poll;
    }
}
