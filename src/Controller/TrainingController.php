<?php

namespace App\Controller;

use App\Entity\Training;
use App\Form\TrainingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TrainingController extends AbstractController
{
    /**
     * @Route("/training/create", name="training/create")
     */
    public function create(Request $request)
    {
        $task = new Training();
        $form = $this->createForm(TrainingType::class, $task);

        return $this->render('training/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
