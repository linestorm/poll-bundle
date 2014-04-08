<?php

namespace LineStorm\PollBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

abstract class PollAnswer
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var string
     */
    protected $ip;

    /**
     * @var PollOption
     */
    protected $option;

    /**
     * @var \DateTime
     */
    protected $answeredOn;

    /**
     * @param \DateTime $answeredOn
     */
    public function setAnsweredOn($answeredOn)
    {
        $this->answeredOn = $answeredOn;
    }

    /**
     * @return \DateTime
     */
    public function getAnsweredOn()
    {
        return $this->answeredOn;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param \LineStorm\PollBundle\Model\PollOption $option
     */
    public function setOption(PollOption $option)
    {
        $this->option = $option;
    }

    /**
     * @return \LineStorm\PollBundle\Model\PollOption
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }


}
