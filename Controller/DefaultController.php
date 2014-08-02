<?php

namespace Asapo\Bundle\TidyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AsapoTidyBundle:Default:index.html.twig', array('name' => $name));
    }
}
