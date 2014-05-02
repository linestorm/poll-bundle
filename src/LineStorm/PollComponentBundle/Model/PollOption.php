<?php

namespace LineStorm\PollComponentBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @var integer
     */
    protected $order;

    /**
     * @var PollAnswer[]
     */
    protected $answers;

    function __construct()
    {
        $this->answers = new ArrayCollection();
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

    public function addAnswer(PollAnswer $answer)
    {
        $this->answers[] = $answer;
    }

    public function removeAnswer(PollAnswer $answer)
    {
        $this->answers->removeElement($answer);
        $answer->setOption($this);
    }

    /**
     * @return PollAnswer[]
     */
    public function getAnswers()
    {
        return $this->answers;
    }



}
