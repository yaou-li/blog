<?php

namespace GarlicBlog\UserBundle\Controller;

use GarlicBlog\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{
    /**
     * @Route("/myProfile", name="user_profile")
     */
    public function profileAction(Request $request)
    {
        
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('homepage');
        }
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userName = $user->getUserName();
        $userId = $user->getId();
        $avatar = empty($user->getAvatar()) ? $this->getParameter('default_avatar') : $user->getAvatar();
        $background = empty($user->getBackGround()) ? $this->getParameter('default_background_color') : $user->getBackGround(); 
        
        return $this->render(
            'GarlicBlogUserBundle:Default:profile.html.twig',
            array(
                'userName' => $userName,
                'userId' => $userId,
                'avatar' => $avatar,
                'nickName' => $user->getNickName(),
                'email' => $user->getEmail(),
                'background' => $background
            )
        );
    }
    
    /**
     * @Route("/updateProfile", name="update_profile")
     */
    public function updateAction(Request $request)
    {
        
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('homepage');
        }
        //possible server-side errors
        $errors = array();
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userId = $user->getId();
        
        //avatar
        $file = $request->files->get('avatar');
        $fileName = $userId.".".$file->guessExtension();
        $user->setAvatar($fileName);
        
        //nickname, email
        $nickname = $request->request->get('nickname');
        $email = $request->request->get('email');
        $user->setNickName($nickname);
        $user->setEmail($email);
        
        //password
        $plainPassword = $request->request->get('password');
        $confirm_password = $request->request->get('confirm_password');
        if (!empty($plainPassword) && $plainPassword == $confirm_password){
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $plainPassword);
            $user->setPassword($password);
        }
    
        //background
        $background = $request->request->get('background_color');
        $user->setBackGround($background);
        
        //update the user entity
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        
        //move the avatar to web directory
        $file->move($this->getParameter('avatar_folder'),$fileName);
        return $this->redirectToRoute('user_profile');
    }
    
}
