<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\form\RegisterType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class UserController extends AbstractController 
{

    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        //crear formulario
        $user = new User();
        $form = $this ->createForm(RegisterType::class, $user);

        //Rellenar el formulario con el objeto
        $form->handleRequest($request);

        //Comprobar si se ha rellenado el formulario
        if($form->isSubmitted() && $form->isValid()){

            //ver si guarda la informacion de forumulario//

           // var_dump($user);

            //Mofidicar el objeto para guardarlo
            $user->setRole('ROLE_USER');
            $user->setCreatedAt(new \Datetime('now'));

            $user->setPassword($passwordHasher->hashPassword(
                $user,$form['password']->getData()

            ));

            //Gurardar usuario

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('task');
        
        
        }



        return $this->render('user/register.html.twig', [
            'controller_name' => 'UserController',
            'form' => $form -> createView()
        ]);
    }

    public function login(AuthenticationUtils $authenticationUtils){
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig', array(
            'error' => $error,
            'last_username'=> $lastUsername
        ));
    }
}
