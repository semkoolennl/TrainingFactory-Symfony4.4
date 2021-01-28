<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\MemberInfoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MemberController extends AbstractController
{
    /**
     * @Route("/user/AddInfo", name="AddMemberInfo")
     */
    public function AddMemberInfo(Request $request)
    {
        $newMember = new Member();
        $form = $this->createForm(MemberInfoType::class, $newMember);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $newMember = $form->getData();
            $newMember->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newMember);
            $entityManager->flush();
            return $this->redirectToRoute('MemberLessons');
        }
        return $this->render('member/AddInfo.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/member/Lessons/{action}", defaults={"action" = false}, name="MemberLessons")
     * @Method("GET")
     * @Template()
     */
    public function ShowLessons($action)
    {
        if ($action) {
            $array = explode('_', $action);
            if ($array[0] == 'next') {
                $startdate = date('Y-m-d', strtotime($array[1]. ' + 7 days'));
            } else {
                $startdate = date('Y-m-d', strtotime($array[1]. ' - 7 days'));
            }
            return $this->render('member/lessons.html.twig', ['startdate' => $startdate]);
        }
        $startdate = date('Y-m-d',strtotime('monday this week'));
        return $this->render('member/lessons.html.twig', ['startdate' => $startdate]);
    }



}
