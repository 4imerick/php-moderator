<?php

namespace App\Controller;

use App\Form\PostFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * Method that display the home page. 
     * @param Request $request 
     * @return Response
     */
    #[Route('/', name: 'home', methods: 'GET|POST')]
    public function home(Request $request): Response
    {
        // We create the form.
        $form = $this->createForm(PostFormType::class);
        // We link the form to the request.
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            dd('Form submitted ✅');

            // We redirect the user.
            return $this->redirectToRoute(
                'home',
                // We set a array of optional data. 
                [],
                // We specify the related HTTP response status code.
                301
            );
        }

        // We display our template. 
        return $this->render(
            'main/home.html.twig',
            // We set a array of optional data.
            [
                'postForm' => $form->createView()
            ],
            // We specify the related HTTP response status code.
            new Response('', 200)
        );
    }
}
