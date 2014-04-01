<?php

namespace LineStorm\PollBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LineStormPollBundle:Default:index.html.twig', array('name' => $name));
    }
}
