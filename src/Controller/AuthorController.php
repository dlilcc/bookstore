<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AuthorController extends AbstractController
{
//     private ProductRepository $repo;
//     public function __construct(ProductRepository $repo)
//    {
//       $this->repo = $repo;
//    }
    /**
     * @Route("/author", name="author_show")
     */
    public function readAllAction(AuthorRepository $repo): Response
    {
        $authors = $repo->findAll();
        return $this->render('author/index.html.twig', [
            'authors'=>$authors
        ]);
    }

     /**
     * @Route("/author/{id}", name="author_read",requirements={"id"="\d+"})
     */
    public function showAction(Author $a): Response
    {
        return $this->render('detail.html.twig', [
            'a' => $a
        ]);
    }

     /**
     * @Route("/author/add", name="author_create")
     */
    public function createAction(Request $req, SluggerInterface $slugger, AuthorRepository $repo): Response
    {
        
        $a = new Author();
        $form = $this->createForm(AuthorType::class, $a);

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid())
        {
            $imgFile = $form->get('file')->getData();
            if ($imgFile) {
                $newFilename = $this->uploadImage($imgFile,$slugger);
                $a->setImage($newFilename);
            }
            $repo->add($a,true);
            return $this->redirectToRoute('author_show', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("author/form.html.twig",[
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/author/edit/{id}", name="author_edit",requirements={"id"="\d+"})
     */
    public function editAction(Request $req, Author $a,
    SluggerInterface $slugger, AuthorRepository $repo): Response
    {
        
        $form = $this->createForm(AuthorType::class, $a);   

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid())
        {
            $imgFile = $form->get('file')->getData();
            if ($imgFile) {
                $newFilename = $this->uploadImage($imgFile,$slugger);
                $a->setImage($newFilename);
            }
            $repo->add($a,true);
            return $this->redirectToRoute('author_show', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("author/form.html.twig",[
            'form' => $form->createView()
        ]);
    }

    public function uploadImage($imgFile, SluggerInterface $slugger): ?string{
        $originalFilename = pathinfo($imgFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$imgFile->guessExtension();
        try {
            $imgFile->move(
                $this->getParameter('image_dir'),
                $newFilename
            );
        } catch (FileException $e) {
            echo $e;
        }
        return $newFilename;
    }

    /**
     * @Route("/author/delete/{id}",name="author_delete",requirements={"id"="\d+"})
     */
    
    public function deleteAction(Author $a, AuthorRepository $repo): Response
    {
        $repo->remove($a,true);
        return $this->redirectToRoute('author_show', [], Response::HTTP_SEE_OTHER);
    }
}

?>