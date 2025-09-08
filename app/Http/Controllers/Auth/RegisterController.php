<?php

namespace Http\Controllers\Auth;

use Core\Response;
use Exception;
use Exceptions\ValidationException;
use Http\Controllers\Controller;
use PDOException;
use Random\RandomException;
use Services\RegisterService;
use Support\Flash;

class RegisterController extends Controller
{
    private RegisterService $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    /**
     * @throws Exception
     */
    public function index(): Response
    {
        return new Response($this->view('auth/registerForm'));
    }

    public function register(array $request): void
    {
        try {
            $this->registerService->register($request);
        } catch (ValidationException $e) {
            foreach ($e->getErrors() as $field => $error) {
                Flash::set($field, $error);
            }
            redirect("/register");
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                Flash::set('email', "Já existe uma conta com este e-mail. Tente fazer login ou use outro e-mail.");
                redirect("/register");
            }

            Flash::set('error', "Não foi possivel, concluir seu registro, tente mais tarde.");
            redirect("/register");

        } catch (RandomException|Exception $e) {
            Flash::set('error', "Não foi possivel, concluir seu registro, tente mais tarde.");
            redirect("/register");
        }

        redirect("/login");
    }
}