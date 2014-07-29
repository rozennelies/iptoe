<?php


namespace Wf3\KikaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;


use \DateTime;

use Wf3\KikaBundle\Form\RegisterType;
use Wf3\KikaBundle\Form\ForgotPasswordType;
use Wf3\KikaBundle\Form\UpdatePasswordType;
use Wf3\KikaBundle\Entity\User;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class UserController extends Controller {

	// affiche et traite le formulaire d'inscription

	public function registerCreateAction(Request $request) {

		$user = new User();
		$register_form = $this->createForm(new RegisterType, $user);

		$register_form->handleRequest($request);

		if ($register_form->isvalid()) {
			//echo('<pre>');
			//var_dump($request);
			//echo('<pre>');

			// sauvegarde de l image dans un dossier
			$dir = $this->get('kernel')->getRootDir() . '/../web/uploadsimg/profil';

			// $file = $user->getImg();  non ..
			$file = $user->getFile();
			$extension = $file->guessExtension();

			//base64_encode(time())
			$newFilename = uniqid().'.'.$extension;

			$file->move($dir, $newFilename);
			$user->setImg($newFilename);


			// go pour l inscription
			//hydrater le reste de l'entité
			$user->setIsActive(true);
			$user->setDateCreated(new DateTime());
			$user->setDateModified(new DateTime());
			$user->setKikoCredit(2);
			

			$generator = new SecureRandom();
			// recup du binaire
			// bin2hex change du binaire en hexa
			// salt
			$salt = bin2hex($generator->nextBytes(40));
			$user->setSalt($salt);
			//echo $random;
			//die();

			//token
			$token = bin2hex($generator->nextBytes(40));
			$user->setToken($token);

			//print_r($user);
			//die(); 

			// hasher le mot de passe
			// on va chercher le service encoder_factory
			$factory = $this->get('security.encoder_factory');


			$encoder = $factory->getEncoder($user);
			$password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
			$user->setPassword($password);

			//print_r($user);
			//die();

			// on est sur l inscription, notre utilisateur est un user 
			//on récupère le role depuis la base
			//pour avoir réellemnt une entité de 
			$roleRepo = $this->getDoctrine()->getRepository("Wf3KikaBundle:Role");
			$role = $roleRepo->findOneByName("ROLE_USER");

			// et on l affecte à notre user
			$user->addRole($role);

			//print_r ($request);

			//print_r($user);	
			// sauvegarde en bdd
			$em = $this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();
		}

		$params = array (
			"register_form" => $register_form->createView()	
			);

		return $this->render("Wf3KikaBundle:User:register_create.html.twig", $params);
	}


	 public function accountAccueilAction()
    {
        return $this->render('Wf3KikaBundle:User:account_accueil.html.twig');
    }

     public function forgotPasswordAction(Request $request)
    {

    	$user = new User();
		$forgot_form = $this->createForm(new ForgotPasswordType, $user);

		$forgot_form->handleRequest($request);

		if ($forgot_form->isvalid()) {
			
			//récupère le repository de User (pour faire des SELECT)
			$userRepository = $this->getDoctrine()->getRepository("Wf3KikaBundle:User");
			//récupère l'objet content dont l'id est égal à 1
			//$content = $contentRepository->find(1);

			$email = $user->getEmail();

			// crée toutes les methodes de recherche pour le select 
			$userForgot = $userRepository->findOneByEmail($email);


			if (!empty($userForgot)) {

			//$name = 'toto';

				$message = \Swift_Message::newInstance()
        			->setSubject('Mot de passe oublié')
        			->setFrom('kikala@example.com')
        			->setTo($email)
        			->setBody($this->renderView('Wf3KikaBundle:Email:email.html.twig', array('name'  => $userForgot->getName(),
        					  'email' => $email,
        			 		  'token' => $userForgot->getToken())),'text/html');

    				$this->get('mailer')->send($message);


    		}
			
			
		}

		$params = array (
			"forgot_form" => $forgot_form->createView()	
			);

	
        return $this->render('Wf3KikaBundle:User:forgot_password.html.twig', $params);
    }


    public function updatePasswordAction(Request $request, $email, $token)
    {

    	$userRepository = $this->getDoctrine()->getRepository("Wf3KikaBundle:User");

        $kikologueFound = $userRepository->findByEmailAndToken($email,$token);

        if ($kikologueFound) {

        	$kikologueFound->setPassword("");

			$update_form = $this->createForm(new UpdatePasswordType, $kikologueFound);

			$update_form->handleRequest($request);

			if ($update_form->isvalid()) {



				$generator = new SecureRandom();
				// recup du binaire
				// bin2hex change du binaire en hexa
				// salt
				$salt = bin2hex($generator->nextBytes(40));
				$kikologueFound->setSalt($salt);

				// hasher le mot de passe
				// on va chercher le service encoder_factory
				$factory = $this->get('security.encoder_factory');


				$encoder = $factory->getEncoder($kikologueFound);

				$password = $encoder->encodePassword($kikologueFound->getPassword(), $kikologueFound->getSalt());
				$kikologueFound->setPassword($password);

				$token = bin2hex($generator->nextBytes(40));
				$kikologueFound->setToken($token);

				$kikologueFound->setDateModified(new DateTime());

				$em = $this->getDoctrine()->getManager();

				$em->persist($kikologueFound);
          		
            	// exécute la requête
            	$em->flush();






			}	
		
    	
			$params = array (
				"update_form" => $update_form->createView()	
			);  

	
        	return $this->render('Wf3KikaBundle:User:update_password.html.twig', $params);

        	
        }
        else
        {
        	return $this->redirect($this->generateUrl('wf3_kika_home')); //redirect
        }

    	
      


    }

	public function loginAction(Request $request)
    {
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        // email entered by the user
        $email = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);
        //$lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);


        return $this->render(
            'Wf3KikaBundle:User:login.html.twig',
            array(
                // email entered by the user
                //'email' 		=> $email,
                'email' 		=> $email,
                'error'         => $error,
            )
        );
    } 




}

