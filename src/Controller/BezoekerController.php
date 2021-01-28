<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class BezoekerController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        if ($user) {
            return $this->redirectToRoute('app_logout');
        }
        return $this->render('bezoeker/index.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function showContact()
    {
        $user = $this->getUser();
        if ($user) {
            return $this->redirectToRoute('app_logout');
        }
        return $this->render('bezoeker/index.html.twig');
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerNewMember(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $newMember = new User();
        $form = $this->createForm(UserType::class, $newMember);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $newMember = $form->getData();
            $newMember->setPassword($passwordEncoder->encodePassword($newMember, $form->get('plainPassword')->getData()));
            $newMember->setRoles(['ROLE_MEMBER']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newMember);
            $entityManager->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->render('bezoeker/register.html.twig', ['form' => $form->createView()]);
    }

}
