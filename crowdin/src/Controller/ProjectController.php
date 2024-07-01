<?php
namespace App\Controller;

use App\Entity\Project;
use App\Repository\SourceRepository;
use App\Repository\SourceLanguageRepository;
use App\Repository\UserLanguageRepository;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Core\Security;

#[Route('/project')]
class ProjectController extends AbstractController
{
    private $csrfTokenManager;
    private $sourceRepository;
    private $entityManager;
    private $sourceLanguageRepository;
    private $userLanguageRepository;

    public function __construct(CsrfTokenManagerInterface $csrfTokenManager, SourceRepository $sourceRepository, EntityManagerInterface $entityManager, SourceLanguageRepository $sourceLanguageRepository, UserLanguageRepository $userLanguageRepository)
    {
        $this->csrfTokenManager = $csrfTokenManager;
        $this->sourceRepository = $sourceRepository;
        $this->entityManager = $entityManager;
        $this->sourceLanguageRepository = $sourceLanguageRepository;
        $this->userLanguageRepository = $userLanguageRepository;
    }

    #[Route('/', name: 'app_project_index', methods: ['GET'])]
    public function index(ProjectRepository $projectRepository): Response
    {
        return $this->render('project/index.html.twig', [
            'projects' => $projectRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_project_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $project = new Project();
        
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            if ($user !== null) {
                // Set the user_id of the project
                $project->setUser($user);
            } else {
                // Handle the case where there is no logged-in user
                throw new \Exception('No user is currently logged in');
            }
    
            // Explicitly persist associated sources
            foreach ($project->getSources() as $source) {
                $entityManager->persist($source);
            }
    
            // Persist the project
            $entityManager->persist($project);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('project/new.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }
    

    #[Route('/{id}', name: 'app_project_show', methods: ['GET'])]
    public function show(Project $project): Response
    {
        $deleteForm = $this->createDeleteForm($project);
        $sources = $project->getSources();

        return $this->render('project/show.html.twig', [
            'project' => $project,
            'delete_form' => $deleteForm->createView(),
            'sources' => $sources,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_project_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Project $project, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            if ($user !== null) {
                // Set the user_id of the project
                $project->setUser($user);
            } else {
                // Handle the case where there is no logged-in user
                throw new \Exception('No user is currently logged in');
            }
            foreach ($project->getSources() as $source) {
                if ($source->getId() === null) {
                    $entityManager->persist($source);
                }
            }

            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
        }

        $deleteForm = $this->createDeleteForm($project);

        return $this->render('project/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_project_delete', methods: ['POST'])]
   #[Route('/{id}', name: 'app_project_delete', methods: ['POST'])]
public function delete(Request $request, Project $project, EntityManagerInterface $entityManager, SourceRepository $sourceRepository, SourceLanguageRepository $sourceLanguageRepository): Response
{
    if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
        //pblm avec foreign keys fot delete maybe need an update on languages for sources
        $sources = $sourceRepository->getManyByProjectId($project->getId());
        foreach ($sources as $source) {
            $sourceLanguages = $sourceLanguageRepository->findBySource($source);
            foreach ($sourceLanguages as $sourceLanguage) {
                $entityManager->remove($sourceLanguage);
            }
            $entityManager->remove($source);
        }
        $entityManager->remove($project);
        $entityManager->flush();
    }

    return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
}

    private function createDeleteForm(Project $project)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_project_delete', ['id' => $project->getId()]))
            ->setMethod('DELETE')
            ->add('_token', HiddenType::class, [
                'data' => $this->csrfTokenManager->getToken('delete'.$project->getId())->getValue(),
            ])
            ->getForm();
    }
}
