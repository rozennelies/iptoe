<?php

namespace Wf3\KikaBundle\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wf3\KikaBundle\Form\AddTrainingType;
use Wf3\KikaBundle\Entity\Training;
use Wf3\KikaBundle\Entity\User;

use \DateTime;


class TrainingController extends Controller
{


	public function openTrainingsAction() {

		//récupère le repository de training (pour faire des SELECT)
        $trainingRepository = $this->getDoctrine()->getRepository("Wf3KikaBundle:Training");

        // création d une requete select afin de ne sélectionner que les formations ouvertes et par date

        //$trainings = $trainingRepository->findAll();

        // on peut aussi utiliser ça
        //$trainings = $repository->findBy(
   		//	 array('status' => 1),
    	//	 array('dateCreated' => 'ASC'),
    	//	 30
		//	);

        $trainings    =  $trainingRepository->findOpenTrainings();

        // grosse débile j ai un array d oblet et pas un objet
        //$nbPlaceTot   =  $training->getNumberPlaces();
        //$nbStudent    =  $training->getNumberStudent();
        //$nbPlaceOpen  =  $nbPlaceTot - $nbStudent;


        $params = array (
        	"trainings" => $trainings);



		 return $this->render('Wf3KikaBundle:Training:open_trainings.html.twig',$params);


	}	


	public function trainingDetailsAction($id) {

	//récupère le repository de training (pour faire des SELECT)
    //    $trainingRepository = $this->getDoctrine()->getRepository("Wf3KikaBundle:Training");

        // on va déplacer la requete dans le repository 
    //    $training = $trainingRepository->findTrainingDetails($id);


        //shoote ça à la vue
     //   $params = array (
     //       "trainingDetails" => $trainingDetails
     //       );

     //   return $this->render("Wf3KikaBundle:Training:training_details.html.twig",$params);


	}


	public function addTrainingAction(Request $request) {

		$coach = $this->getUser();

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
			$training->setStatus(1);
			$training->setNumberStudent(0);
			$training->setDateCreated(new DateTime());

			// on passe l objet en entier 
			$training->setCoach($coach);

			$em = $this->getDoctrine()->getManager();
			$em->persist($training);
			$em->flush();	


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
