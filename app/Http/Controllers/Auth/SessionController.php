<?php

namespace Http\Controllers\Auth;

use Core\Response;
use Exception;
use Exceptions\ValidationException;
use Http\Controllers\Controller;
use JetBrains\PhpStorm\NoReturn;
use Services\SessionService;
use Support\Flash;

class SessionController extends Controller
{

    private SessionService $sessionService;

    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    /**
     * @throws Exception
     */
    public function index(): Response
    {
        return new Response($this->view('auth/sessionForm'));
    }

    public function store(array $request): void
    {
        try {
            $this->sessionService->session($request);
        } catch (ValidationException $e) {
            if (is_array($e->getErrors())) {
                foreach ($e->getErrors() as $field => $error) {
                    Flash::set($field, $error);
                }
            }

            Flash::set('error', $e->getErrors());
            redirect("/login");
        }

        redirect("/");
    }

    #[NoReturn]
    public function destroy(array $request): void
    {
        try {
            $this->sessionService->killSession();
        } catch (ValidationException $e) {
            Flash::set('error', $e->getMessage());
        }

        redirect("/");
    }
}