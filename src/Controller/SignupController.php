<?php

namespace App\Controller;

use App\Entity\User;
use App\Enumeration\TokenType;
use App\Form\SignupType;
use App\Repository\UserRepository;
use App\Service\EmailService;
use App\Service\TokenService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SignupController extends AbstractController
{
    private $tokenService;
    private UserRepository $userRepository;

    public function __construct(TokenService $tokenService, UserRepository $userRepository)
    {
        $this->tokenService = $tokenService;
        $this->userRepository = $userRepository;
    }
    
    /**
     * This method registers a user in the database
     * and sends a confirmation link to the user
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordHasherInterface $passwordHasher
     * @param EmailService $email
     * @param MailerInterface $mailer
     * @return Response
     */
    #[Route('/signup', name: 'app_signup')]
    public function index(
        Request $request, 
        EntityManagerInterface $manager, 
        UserPasswordHasherInterface $passwordHasher, 
        EmailService $email, 
        MailerInterface $mailer,
        ): Response
    {
        $user = new User();

        $signupForm = $this->createForm(SignupType::class, $user);
        $signupForm->handleRequest($request);

        if($signupForm->isSubmitted() && $signupForm->isValid())
        {
            $user = $signupForm->getData();

            /**
             * hashage de mot de passe
             */
            $plainTextPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword($user, $plainTextPassword);
            $user->setPassword($hashedPassword);

            /**
             * Vérifier l'utilisateur existe déjà
             */
            $existingUser = $this->userRepository->findOneBy(['email' => $user->getEmail()]);
            if($existingUser){
                $this->addFlash('warning', "L'utilisateur avec cette adresse e-mail existe déjà.");
                return $this->redirectToRoute('app_signup');
            }else{
                /**
                 * L'enregistrement l'utilisateur dans la base de données
                 */
                
                try {
                    $manager->persist($user);
                    $manager->flush();

                    $token = $this->tokenService->createToken(TokenType::RegistrationToken, $user);

                    $validationUrl = $this->generateUrl('app_account_validation', ['token' => $token->getToken()], UrlGeneratorInterface::ABSOLUTE_URL);

                    $email = (new Email())
                        ->from("your_email@exemple.com")
                        ->to($user->getEmail())
                        ->subject('comfirmer votre email')
                        ->html('<p>To confirm your email address, please click on the following link: <a href="'.$validationUrl.'">Confirm my email</a></p>');
                    
                    $mailer->send($email);
                    
                } catch ( UniqueConstraintViolationException $e) { 
                    $this->addFlash('error', 'Un problème est survenu, l\'adresse email est déjà utilisée.');
                    return $this->redirectToRoute('app_signup');
                }
            }
        }
        
        return $this->render('signup/signup.html.twig', [
            'signupForm' => $signupForm->createView(),
        ]);
    }

    public function getUserByEmail( string $email ): User
    {
        $user = $this->userRepository->findOneBy(['email' => $email]);
        if(!$user){
            throw $this->createNotFoundException('No user found for email ' . $email);
        }

        return $user;
    }
    
}
