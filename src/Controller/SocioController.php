<?php

namespace App\Controller;

use App\Entity\Socio;
use App\Form\SocioType;
use App\Repository\SocioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
class SocioController extends AbstractController
{

    #[Route('/socio/listar', name: 'socio_listar')]
    public function listar(SocioRepository $socioRepository): Response {
        $socios = $socioRepository->findAll();

        return $this->render('listarSocios.html.twig', [
            'socios' => $socios
        ]);
    }

    #[Route('/socio/nuevo', name: 'socio_nuevo')]
    #[Route('/socio/modificar/{id}', name: 'socio_modificar')]
    public function editar(Request $request, Socio $socio = null, EntityManagerInterface $em): Response {
        if (!$socio) $socio = new Socio();

        $form = $this->createForm(SocioType::class, $socio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($socio);
            $em->flush();
            return $this->redirectToRoute('socio_listar');
        }

        return $this->render('formularioSocios.html.twig', [
            'form' => $form->createView(),
            'editMode' => $socio->getId() !== null
        ]);
    }

}