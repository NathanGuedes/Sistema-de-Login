<?php

namespace Http\Controllers\Auth;


use Core\Response;
use Exception;
use Exceptions\ActiveValidationException;
use Exceptions\InvalidTokenException;
use Http\Controllers\Controller;
use Services\SessionService;
use Services\UserManagerService;
use Support\Flash;
use Support\SessionManager;

class UserManagerController extends Controller
{
    public function __construct(private readonly UserManagerService $userManagerService,
                                private readonly SessionService $sessionService,
                                private readonly SessionManager $sessionManager
    ){}

    /**
     * @throws Exception
     */
    public function startSendEmailActivation(string $userEmail): void
    {
        $user = $this->sessionManager->get('user');

        $this->userManagerService->emailActiveSend($user);

        $this->sessionService->killSession();

        new Response($this->view('auth/validateEmail', [
            'email' => $userEmail
        ]))->send();
    }

    /**
     * @throws Exception
     */
    public function confirmEmailActivation(array $token): void
    {
        $token = $token['token'];
        try {
            $this->userManagerService->confirmEmail($token);
        } catch (InvalidTokenException $e) {
            Response::redirect('/login', [
                'error' => 'Link de confirmação inválido'
            ]);
        } catch (ActiveValidationException $e) {
            $this->sessionService->startSessionLogin([
                'name' => $e->getDataError()['name'],
                'email' => $e->getDataError()['email']
            ]);
            $this->startSendEmailActivation($e->getDataError()['email']);
        }

        Flash::set('success', 'Conta ativada com sucesso!');
        Response::redirect('/login');
    }
}