<?php

namespace LineStorm\PollComponentBundle\Controller\Api;

use Doctrine\ORM\Query;
use FOS\RestBundle\Routing\ClassResourceInterface;
use LineStorm\CmsBundle\Controller\Api\AbstractApiController;

/**
 * Class OptionController
 *
 * @package LineStorm\PollComponentBundle\Controller\Api
 * @author  Andy Thorne <contrabandvr@gmail.com>
 */
class OptionController extends AbstractApiController implements ClassResourceInterface
{

    /**
     * Get a list of all consumables
     *
     * [GET] /api/cms/polls.{_format}
     */
    public function cgetAction($id)
    {
        $modelManager = $this->getModelManager();

        $em = $modelManager->getManager();

        $now = new \DateTime();

        $dql = "
            SELECT
                p,o
            FROM
                {$modelManager->getEntityClass('poll')} p
                JOIN p.options o
            WHERE
              p.startDate <= :date
              AND (p.endDate >= :date OR p.endDate IS NULL)
        ";
        $polls = $em->createQuery($dql)->setParameters(array(
            'date' => $now,
        ))->getArrayResult();

        $view = $this->createResponse($polls);

        return $this->get('fos_rest.view_handler')->handle($view);
    }


    /**
     * Get a post
     *
     * [GET] /api/cms/poll/{id}.{_format}
     */
    public function getAction($poll, $id)
    {
        $modelManager = $this->getModelManager();

        $em = $modelManager->getManager();

        $dql = "
            SELECT
                p,o
            FROM
                {$modelManager->getEntityClass('poll')} p
                JOIN p.options o
            WHERE
                p.id = ?1
                AND p.startDate <= :date
                AND (p.endDate >= :date OR p.endDate IS NULL)
        ";
        $polls = $em->createQuery($dql)->setParameters(array(
            1      => $id,
            'date' => new \DateTime(),
        ))->getSingleResult(Query::HYDRATE_ARRAY);

        $view = $this->createResponse($polls);

        return $this->get('fos_rest.view_handler')->handle($view);
    }

}
