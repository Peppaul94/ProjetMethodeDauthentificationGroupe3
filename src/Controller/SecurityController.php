<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Google\GoogleAuthenticatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

/**
 * Controller used to manage the application security.
 */
final class SecurityController extends AbstractController
{
    use TargetPathTrait;

    /**
     * Page de login.
     */
    #[Route('/login', name: 'security_login')]
    public function login(
        #[CurrentUser] ?User $user,
        Request $request,
        AuthenticationUtils $helper
    ): Response {
        // Si déjà connecté, rediriger vers l'admin
        if ($user) {
            // S'il n'a pas encore de secret Google Auth, on l'envoie sur la page QR
            if (!$user->isGoogleAuthenticatorEnabled()) {
                return $this->redirectToRoute('2fa_setup', ['_locale' => 'fr']);
            }
    
            // Sinon, on le laisse aller sur l’admin
            return $this->redirectToRoute('admin_post_index');
        }

        // Garde le chemin de redirection après login dans la bonne locale
        $this->saveTargetPath(
            $request->getSession(),
            'main',
            $this->generateUrl('admin_index')
        );

        return $this->render('security/login.html.twig', [
            'last_username' => $helper->getLastUsername(),
            'error'         => $helper->getLastAuthenticationError(),
        ]);
    }

    /**
     * Setup de la 2FA Google Authenticator : génération du secret + QR code.
     */
    #[Route('/2fa/setup', name: '2fa_setup')]
    public function setup2fa(
        GoogleAuthenticatorInterface $googleAuthenticator,
        EntityManagerInterface $em,
        #[CurrentUser] ?User $user
    ): Response {
        // 1) Générer un secret et le stocker
        $secret = $googleAuthenticator->generateSecret();
        $user->setGoogleAuthenticatorSecret($secret);
        $em->flush();

        // 2) Obtenir la chaîne otpauth://... à encoder
        $qrContent = $googleAuthenticator->getQRContent($user);

        // 3) Construire une URL de QR code (service public simple)
        //    Ici on passe le contenu à l’API qrserver (200×200 px)
        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data='
            . urlencode($qrContent);

        // 4) Afficher la page de configuration
        return $this->render('security/2fa_setup.html.twig', [
            'qrCodeUrl' => $qrCodeUrl,
            'secret'    => $secret,   // au cas où l’utilisateur préfère saisir à la main
        ]);
    }
}
