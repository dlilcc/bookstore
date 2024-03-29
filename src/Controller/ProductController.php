<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\String\Slugger\SluggerInterface;

use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
//     private ProductRepository $repo;
//     public function __construct(ProductRepository $repo)
//    {
//       $this->repo = $repo;
//    }
    /**
     * @Route("/", name="product_show")
     */
    public function readAllAction(ProductRepository $repo): HttpFoundationResponse
    {
        $products = $repo->findAll();
        return $this->render('product/index.html.twig', [
            'products'=>$products
        ]);
    }

     /**
     * @Route("/{id}", name="product_read",requirements={"id"="\d+"})
     */
    public function showAction(Product $p): HttpFoundationResponse
    {
        return $this->render('detail.html.twig', [
            'p'=>$p
        ]);
    }

     /**
     * @Route("/add", name="product_create")
     */
    public function createAction(HttpFoundationRequest $req, SluggerInterface $slugger, ProductRepository $repo): HttpFoundationResponse
    {
        
        $p = new Product();
        $form = $this->createForm(ProductType::class, $p);

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            if($p->getCreated()===null){
                $p->setCreated(new \DateTime());
            }
            $imgFile = $form->get('file')->getData();
            if ($imgFile) {
                $newFilename = $this->uploadImage($imgFile,$slugger);
                $p->setImage($newFilename);
            }
            $repo->add($p,true);
            return $this->redirectToRoute('product_show', [], HttpFoundationResponse::HTTP_SEE_OTHER);
        }
        return $this->render("product/form.html.twig",[
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/edit/{id}", name="product_edit",requirements={"id"="\d+"})
     */
    public function editAction(HttpFoundationRequest $req, Product $p,
    SluggerInterface $slugger, ProductRepository $repo): HttpFoundationResponse
    {
        
        $form = $this->createForm(ProductType::class, $p);   

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){

            if($p->getCreated()===null){
                $p->setCreated(new \DateTime());
            }
            $imgFile = $form->get('file')->getData();
            if ($imgFile) {
                $newFilename = $this->uploadImage($imgFile,$slugger);
                $p->setImage($newFilename);
            }
            $repo->add($p,true);
            return $this->redirectToRoute('product_show', [], HttpFoundationResponse::HTTP_SEE_OTHER);
        }
        return $this->render("product/form.html.twig",[
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
     * @Route("/delete/{id}",name="product_delete",requirements={"id"="\d+"})
     */
    
    public function deleteAction(HttpFoundationRequest $request, Product $p, ProductRepository $repo): HttpFoundationResponse
    {
        $repo->remove($p,true);
        return $this->redirectToRoute('product_show', [], HttpFoundationResponse::HTTP_SEE_OTHER);
    }
}

?>
