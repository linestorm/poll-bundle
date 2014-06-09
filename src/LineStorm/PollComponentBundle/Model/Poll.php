<?php

namespace LineStorm\PollComponentBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use LineStorm\Content\Model\ContentNodeInterface;

/**
 * Class Poll
 *
 * @package LineStorm\PollComponentBundle\Model
 * @author  Andy Thorne <contrabandvr@gmail.com>
 */
abstract class Poll
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var PollOption[]
     */
    protected $options;

    /**
     * @var \DateTime
     */
    protected $createdOn;

    /**
     * @var \DateTime
     */
    protected $startDate;

    /**
     * @var \DateTime
     */
    protected $endDate;

    /**
     * @var boolean
     */
    protected $allowAnonymous;

    /**
     * @var integer
     */
    protected $order;

    /**
     * @var boolean
     */
    protected $multiple;

    /**
     * @var ContentNodeInterface
     */
    protected $contentNode;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add options
     *
     * @param PollOption $options
     * @return Poll
     */
    public function addOption(PollOption $options)
    {
        $this->options[] = $options;
        $options->setPoll($this);

        return $this;
    }

    /**
     * Remove options
     *
     * @param PollOption $options
     */
    public function removeOption(PollOption $options)
    {
        $this->options->removeElement($options);
    }

    /**
     * Get options
     *
     * @return Collection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param boolean $allowAnonymous
     */
    public function setAllowAnonymous($allowAnonymous)
    {
        $this->allowAnonymous = $allowAnonymous;
    }

    /**
     * @return boolean
     */
    public function getAllowAnonymous()
    {
        return $this->allowAnonymous;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param \DateTime $createdOn
     */
    public function setCreatedOn(\DateTime $createdOn)
    {
        $this->createdOn = $createdOn;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate(\DateTime $endDate = null)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param int $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param boolean $multiple
     */
    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;
    }

    /**
     * @return boolean
     */
    public function getMultiple()
    {
        return $this->multiple;
    }

    /**
     * @param ContentNodeInterface $contentNode
     */
    public function setContentNode(ContentNodeInterface $contentNode)
    {
        $this->contentNode = $contentNode;
    }

    /**
     * @return ContentNodeInterface
     */
    public function getContentNode()
    {
        return $this->contentNode;
    }

}
