<?php

namespace App\Controller;

use App\Entity\Autor;
use App\Repository\LibroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function autorPorId(Autor $autor)
    {

    }

}