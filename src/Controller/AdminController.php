<?php

namespace App\Controller;

use App\Entity\Instructor;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin/instructors", name="Instructors")
     */
    public function ShowInstructors()
    {
        $instructorManager = $this->getDoctrine()->getRepository(Instructor::class);
        // look for *all* Product objects
        $instructors = $instructorManager->findAll();
        $userManager = $this->getDoctrine()->getRepository(User::class);
        $infoArray = [];
        foreach($instructors as $instructor) {
            $user = $userManager->findOneBy(['id' => $instructor->getUser()->getId() ]);
            array_push($infoArray, [$user, $instructor]);
        }
        return $this->render('admin/instructors.html.twig', ['instructors' => $instructors]);
    }

}
