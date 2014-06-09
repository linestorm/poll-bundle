<?php

namespace LineStorm\PollComponentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use LineStorm\PollComponentBundle\Model\PollAnswer as BasePollAnswer;
use Andy\PortfolioBundle\Entity\PollOption;

/**
 * Class PollAnswer
 *
 * @package LineStorm\PollComponentBundle\Model
 * @author  Andy Thorne <contrabandvr@gmail.com>
 */
class PollAnswer extends BasePollAnswer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var PollOption
     *
     * @ORM\ManyToOne(targetEntity="PollOption", inversedBy="answers", cascade={"remove"})
     */
    protected $option;
}
