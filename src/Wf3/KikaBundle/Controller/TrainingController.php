<?php

namespace Wf3\KikaBundle\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wf3\KikaBundle\Form\AddTrainingType;
use Wf3\KikaBundle\Entity\Training;
use Wf3\KikaBundle\Entity\User;

class TrainingController extends Controller
{


	public function openTrainingsAction() {

		 return $this->render('Wf3KikaBundle:Training:open_trainings.html.twig');


	}	

	public function addTrainingAction(Request $request) {

		$training = new Training();
		$training_form = $this->createForm(new AddTrainingType, $training);

		$training_form->handleRequest($request);

		if ($training_form->isvalid()) {

			// sauvegarde de l image dans un dossier
			$dir = $this->get('kernel')->getRootDir() . '/../web/uploadsimg/training';

			// $file = $user->getImg();  non ..
			$file = $training->getFile();
			$extension = $file->guessExtension();

			//base64_encode(time())
			$newFilename = uniqid().'.'.$extension;

			$file->move($dir, $newFilename);
			$training->setImg($newFilename);


		}
		
		$params = array (
			"training_form" => $training_form->createView()	
			);	





		 return $this->render('Wf3KikaBundle:Training:add_training.html.twig',$params);


	}	

	public function myTrainingsAction() {

		 return $this->render('Wf3KikaBundle:Training:my_trainings.html.twig');


	}	

	public function mySubscriptionsAction() {

		 return $this->render('Wf3KikaBundle:Training:my_subscriptions.html.twig');


	}	



    public function indexAction($name)
    {
        return $this->render('Wf3KikaBundle:Default:index.html.twig', array('name' => $name));
    }
}
