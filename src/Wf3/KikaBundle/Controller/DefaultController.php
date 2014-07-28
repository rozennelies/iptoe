<?php

namespace Wf3\KikaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('Wf3KikaBundle:Default:index.html.twig', array('name' => $name));
    }

    

    public function homeAction() {

        // appel au conteneur de services pour récupérer le 'test_service' 

        //$testService = $this->get("wf3_wiki.test_service");
        //$testService->setContent(new Content());
        //$testService->saveToDb();
    	// instanciation d'un objet
		//$content = new Content(); 
		// hydratation d un objet
		//$content->setTitle("Premier titre");
		//$content->setContent("Premier contenu");
		//$content->setDateCreated(new DateTime());

		// récupération du manager pour sauvegarder l'entity
        //$em = $this->getDoctrine()->getManager();
        // sauvegarder l objet
        //$em->persist($content);

        // exécute la requête
        
        //$em->flush();

        //récupère le repository de User (pour faire des SELECT)
        $userRepository = $this->getDoctrine()->getRepository("Wf3KikaBundle:User");

        $kikologueInscrit = $userRepository->findKikologuesInscrits();


        $trainingRepository = $this->getDoctrine()->getRepository("Wf3KikaBundle:Training");

        $kikalaFormations = $trainingRepository->findKikalaFormations();

       // echo ($kikalaFormations);

        //if (empty($kikalaFormations)) {
        //   $kikalaFormations = 0;
        //}


        //shoote ça à la vue
        $params = array (
            "kikologueInscrit" => $kikologueInscrit,
            "kikalaFormations" => $kikalaFormations 
            );

    	return $this->render('Wf3KikaBundle:Default:home.html.twig',$params);

    } 

     public function aproposAction() {
    	return $this->render('Wf3KikaBundle:Default:apropos.html.twig');

    } 


    public function legalAction() {

    	//récupère le repository de Content (pour faire des SELECT)
		//$contentRepository = $this->getDoctrine()->getRepository("Wf3WikiBundle:Content");
		//récupère l'objet content dont l'id est égal à 1
		//$content = $contentRepository->find(1);

		// crée toutes les methodes de recherche pour le select 
		//$content = $contentRepository->findOneByTitle("Premier Titre");

		//print_r($content);





    	//$d = new DateTime();	

    	//$params = array(
    	//	"d" => $d
    	//	);
    	// on aurrait pu aussi faire comme ça
    	//$params = array(
    	//	"d" 		=> $d
    	//  "content" 	=> $content
    	//	);


    	//$params['content'] =  $content;
    	//return $this->render('Wf3WikiBundle:Default:legal.html.twig',$params);

    	return $this->render('Wf3KikaBundle:Default:legal.html.twig');


    } 
}
