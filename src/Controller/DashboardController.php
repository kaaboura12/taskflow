<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard')]
    public function index(TaskRepository $taskRepository): Response
    {
        // If not logged in, show welcome page
        if (!$this->getUser()) {
            return $this->render('dashboard/welcome.html.twig');
        }

        // Get tasks for dashboard
        $user = $this->getUser();
        $userTasks = $taskRepository->findByUser($user);
        
        // Count tasks by status
        $todoCount = count($taskRepository->findByStatus('todo'));
        $inProgressCount = count($taskRepository->findByStatus('in_progress'));
        $reviewCount = count($taskRepository->findByStatus('review'));
        $doneCount = count($taskRepository->findByStatus('done'));
        
        return $this->render('dashboard/index.html.twig', [
            'user_tasks' => $userTasks,
            'task_counts' => [
                'todo' => $todoCount,
                'in_progress' => $inProgressCount,
                'review' => $reviewCount,
                'done' => $doneCount,
                'total' => $todoCount + $inProgressCount + $reviewCount + $doneCount
            ]
        ]);
    }
    
    #[Route('/profile', name: 'app_profile')]
    #[IsGranted('ROLE_USER')]
    public function profile(TaskRepository $taskRepository): Response
    {
        $user = $this->getUser();
        
        // Get recent tasks (limited to 5)
        $recentTasks = $taskRepository->findBy(
            ['assignedTo' => $user],
            ['createdAt' => 'DESC'],
            5
        );
        
        return $this->render('dashboard/profile.html.twig', [
            'user' => $user,
            'recent_tasks' => $recentTasks
        ]);
    }
    
    #[Route('/profile/update', name: 'app_profile_update', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function updateProfile(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $firstName = $request->request->get('firstName');
        $lastName = $request->request->get('lastName');
        $email = $request->request->get('email');
        
        // Update user data
        if ($firstName && $lastName && $email) {
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setEmail($email);
            
            // Handle profile picture if uploaded
            $profilePicture = $request->files->get('profilePicture');
            if ($profilePicture) {
                // In a real application, handle file upload properly
                // This is just a placeholder
                // $filename = $fileUploader->upload($profilePicture);
                // $user->setProfilePicture($filename);
            }
            
            $entityManager->flush();
            
            $this->addFlash('success', 'Profile updated successfully!');
        } else {
            $this->addFlash('danger', 'Please fill in all required fields.');
        }
        
        return $this->redirectToRoute('app_profile');
    }
    
    #[Route('/profile/change-password', name: 'app_change_password', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function changePassword(
        Request $request, 
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager
    ): Response
    {
        $user = $this->getUser();
        $currentPassword = $request->request->get('currentPassword');
        $newPassword = $request->request->get('newPassword');
        $confirmPassword = $request->request->get('confirmPassword');
        
        // Verify current password
        if (!$passwordHasher->isPasswordValid($user, $currentPassword)) {
            $this->addFlash('danger', 'Current password is incorrect.');
            return $this->redirectToRoute('app_profile');
        }
        
        // Check if new passwords match
        if ($newPassword !== $confirmPassword) {
            $this->addFlash('danger', 'New passwords do not match.');
            return $this->redirectToRoute('app_profile');
        }
        
        // Update password
        $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
        $user->setPassword($hashedPassword);
        
        $entityManager->flush();
        
        $this->addFlash('success', 'Password updated successfully!');
        return $this->redirectToRoute('app_profile');
    }
} 