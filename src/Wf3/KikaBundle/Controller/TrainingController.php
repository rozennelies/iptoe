<?php

namespace Wf3\KikaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TrainingController extends Controller
{


	public function openTrainingsAction() {

		 return $this->render('Wf3KikaBundle:Training:open_trainings.html.twig');


	}	


    public function indexAction($name)
    {
        return $this->render('Wf3KikaBundle:Default:index.html.twig', array('name' => $name));
    }
}
