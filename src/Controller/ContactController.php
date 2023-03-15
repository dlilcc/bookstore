<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ContactController extends AbstractController
{



     /**
     * @Route("/contact/add", name="contact_create")
     */
    public function createAction(Request $req, ContactRepository $repo): Response
    {
        
        $c = new Contact();
        $form = $this->createForm(ContactType::class, $c);

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid())
        {
            $repo->add($c,true);
            return $this->redirectToRoute('homepage', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("contact/form.html.twig",[
            'form' => $form->createView()
        ]);
    }
}
?>