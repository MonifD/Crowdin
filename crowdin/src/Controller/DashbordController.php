<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\UserLanguage;
use App\Form\UserEditType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/dashbord')]
class DashbordController extends AbstractController
{
    #[Route('/', name: 'app_dashbord')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {   
        $user = $this->getUser();
        $userLanguages = $em->getRepository(UserLanguage::class)->findBy(['user' => $user]);
        return $this->render('dashbord/index.html.twig', [
            'profil' => $user,
            'userLanguages' => $userLanguages
        ]);
    }

    #[Route(path: '/profil', name: 'app_profil')]
    public function profil(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $userLanguages = $em->getRepository(UserLanguage::class)->findBy(['user' => $user]);
        return $this->render('profil/profil.html.twig', [
            'profil' => $user,
            'userLanguages' => $userLanguages
        ]);
    }

    #[Route(path: '/profil/edit', name: 'app_profil_edit')]
    public function edit(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $user->setUpdateAt(new \DateTimeImmutable());
        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle language updates
            $languages = $form->get('languages')->getData();
            foreach ($languages as $language) {
                // Check if the language already exists for the user
                if (!$user->getLanguages()->contains($language)) {
                    // If the language doesn't exist, add it to the user
                    $user->addLanguage($language);
                }
            }  
    
            // Persist user changes
            $em->persist($user);
            $em->flush();
    
            $this->addFlash('success', 'Profile updated successfully!');
    
            return $this->redirectToRoute('app_profil');
        }
    
        return $this->render('profil/profil_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}