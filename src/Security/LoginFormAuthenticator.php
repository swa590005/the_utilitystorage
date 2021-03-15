<?php

namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{

    private $userRepository;
    private $router;

    public function __construct(UserRepository $userRepository, RouterInterface $router)
    {
        $this->userRepository = $userRepository;
        $this->router = $router;
    }


    /* It doesn't matter what URL we go to: the supports() method is always called at the start of the request.*/
    public function supports(Request $request): bool
    {
        return $request->attributes->get('_route')=== 'app_login'
            && $request->isMethod('POST');
    }

    //function job is to read our authentication credentials off of the request and return them
    public function getCredentials(Request $request): array
    {
        $credentials= [
            'email'=>$request->request->get('email'),
            'password'=>$request->request->get('password')
        ];
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['email']
        );

        return $credentials;
    }

    //use credential and find our user. This will return our User object, or null
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $this->userRepository->findOneBy(['email'=> $credentials['email']]);
    }

    public function checkCredentials($credentials, UserInterface $user): bool
    {
        return true;
    }


    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return new RedirectResponse($this->router->generate('app_homepage'));
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('app_login');
    }


}
