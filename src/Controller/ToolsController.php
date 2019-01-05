<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToolsController extends AbstractController
{
    /**
     * @Route("/tools/md5", name="md5")
     *
     * @param Request $request
     * @return Response
     */
    public function md5Action(Request $request)
    {
        $result = '';

        $form = $this->createFormBuilder()
            ->add('value', TextType::class, [
                'attr' => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('convert', SubmitType::class, array(
                'label' => 'Convert'
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = md5($form->getData()['value']);
        }

        return $this->render('Tools/md5.html.twig', [
            'form' => $form->createView(),
            'result' => $result
        ]);
    }
}
