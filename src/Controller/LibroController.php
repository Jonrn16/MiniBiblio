<?php

namespace App\Controller;

use App\Entity\Autor;
use App\Entity\Libro;
use App\Repository\LibroRepository;
use Doctrine\ORM\EntityManagerInterface;
use LibroType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibroController extends AbstractController
{

    #[Route("/libro/listar", name: "libro_listar")]
    public function listar(LibroRepository $libroRepository) : Response
    {
        return $this->render("libroListar.html.twig", [
            'libros' => $libroRepository->findAll()
        ]);

    }

    #[Route("/libro/autores/{id}", name: "libro_autores")]
    public function autorPorId(LibroRepository $libroRepository, int $id) : Response
    {
        $libro = $libroRepository->find($id);
        return $this->render("libroAutores.html.twig",["libro" => $libro]);
    }

    #[Route('/libro/nuevo', name: 'libro_nuevo')]
    public function nuevo(Request $request, EntityManagerInterface $em): Response
    {
        $libro = new Libro();
        return $this->modificar($request, $libro, $em);
    }

    #[Route('/libro/modificar/{id}', name: 'libro_modificar')]
    public function modificar(Request $request, Libro $libro, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(LibroType::class, $libro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($libro);
            $em->flush();
            return $this->redirectToRoute('libro_listar');
        }

        return $this->render('libro/modificar.html.twig', [
            'form' => $form->createView(),
            'libro' => $libro,
        ]);
    }

}