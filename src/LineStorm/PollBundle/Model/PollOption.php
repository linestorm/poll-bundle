<?php

namespace LineStorm\PollBundle\Model;

use Doctrine\ORM\Mapping as ORM;

abstract class PollOption
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $answer;

    /**
     * @var Poll
     */
    protected $poll;

    /**
     * @var boolean
     */
    protected $isCorrect;

    /**
     * @var integer
     */
    protected $order;



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
     * Set poll
     *
     * @param Poll $poll
     * @return PollOption
     */
    public function setPoll(Poll $poll = null)
    {
        $this->poll = $poll;

        return $this;
    }

    /**
     * Get poll
     *
     * @return Poll
     */
    public function getPoll()
    {
        return $this->poll;
    }

    /**
     * @param string $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    /**
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param boolean $isCorrect
     */
    public function setIsCorrect($isCorrect)
    {
        $this->isCorrect = $isCorrect;
    }

    /**
     * @return boolean
     */
    public function getIsCorrect()
    {
        return $this->isCorrect;
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


}
