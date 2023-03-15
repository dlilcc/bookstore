<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category_show")
     */
    public function readAllAction(CategoryRepository $repo): Response
    {
        $category = $repo->findAll();
        return $this->render('category/index.html.twig', [
            'category'=> $category
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_read",requirements={"id"="\d+"})
     */
    public function showAction(Category $c): Response
    {
        return $this->render('detail.html.twig', [
            'c'=>$c
        ]);
    }

    /**
     * @Route("/category/add", name="category_create")
     */
    public function createAction(Request $req, CategoryRepository $repo): Response
    {
        
        $c = new Category();
        $form = $this->createForm(CategoryType::class, $c);

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $repo->add($c,true);
            return $this->redirectToRoute('category_show', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("category/form.html.twig",[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/category/edit/{id}", name="category_edit",requirements={"id"="\d+"})
     */
    public function editAction(Request $req, Category $c,
    CategoryRepository $repo): Response
    {
        
        $form = $this->createForm(CategoryType::class, $c);   

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $repo->add($c,true);
            return $this->redirectToRoute('category_show', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("category/form.html.twig",[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/category/delete/{id}",name="category_delete",requirements={"id"="\d+"})
     */
     public function deleteAction(Category $c, CategoryRepository $repo): Response
     {
         $repo->remove($c,true);
         return $this->redirectToRoute('category_show', [], Response::HTTP_SEE_OTHER);
     }
}
?>
