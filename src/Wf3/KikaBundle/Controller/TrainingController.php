<?php

namespace Wf3\KikaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('Wf3KikaBundle:Default:index.html.twig', array('name' => $name));
    }
}
