<?php

namespace Wf3\KikaBundle\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wf3\KikaBundle\Form\AddTrainingType;
use Wf3\KikaBundle\Entity\Training;
use Wf3\KikaBundle\Entity\User;
use Wf3\KikaBundle\Entity\Subscription;

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
    $trainingRepository = $this->getDoctrine()->getRepository("Wf3KikaBundle:Training");

    // on va déplacer la requete dans le repository si on veut une rquete plus fine
    //    $training = $trainingRepository->findTrainingDetails($id);

    $user = $this->getUser();

    $training = $trainingRepository->find($id);


    // vérifier si l'utilisateur est connecté et déjà inscrit  à cette formation. utilisation du repository subscription

    if($user)    {

    	$subscriptionRepository = $this->getDoctrine()->getRepository("Wf3KikaBundle:Subscription");

    	$subscription = $subscriptionRepository->findBy(
   			 array('user' => $user,'training' => $training)
    		 			);

       // $trainings    =  $trainingRepository->findOpenTrainings();

    	print_r($subscription);




    }   




    //shoote ça à la vue
    $params = array (
          "trainingDetails" => $training,
          "user" => $user
           );

     return $this->render("Wf3KikaBundle:Training:training_details.html.twig",$params);


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


    public function subscriptionCreateAction($id) {

    	// ici on passe l id de la formation , il faut vérifier que l od est numérique sinon on vire ....

    	$user = $this->getUser();

    	$trainingRepository = $this->getDoctrine()->getRepository("Wf3KikaBundle:Training");

   		$training = $trainingRepository->find($id);


   		// on crée l instance subscription

   		$subscription = new Subscription();


   		// on passe l objet en entier  correspondant à l'utilisateur
		$subscription->setUser($user);

		// on passe l objet en entier  correspondant à la formation
		$subscription->setTraining($training);
		$subscription->setDateCreated(new DateTime());
		$subscription->setIsActive(true);

		// pas besoin 

		$em = $this->getDoctrine()->getManager();
		$em->persist($subscription);
		$em->flush();	

		// ça plante !!!!!! on n a pas la liste des données
		//return $this->render('Wf3KikaBundle:Training:open_trainings.html.twig'); 

		return $this->redirect($this->generateUrl('wf3_kika_openTrainings')); 
  






    }

    public function subscriptionDeleteAction($id) {


    }



}
