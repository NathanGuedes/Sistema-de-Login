<?php

namespace Http\Controllers\Auth;

use Core\Response;
use Exception;
use Exceptions\ValidationException;
use Http\Controllers\Controller;
use Services\SessionService;
use Support\Flash;

class SessionController extends Controller
{

    public function __construct(private readonly SessionService $sessionService)
    {
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
            $errors = $e->getErrors();
            if (is_array($errors)) {
                foreach ($errors as $field => $error) {
                    Flash::set($field, $error);
                }
            } else {
                Flash::set('error', $errors);
            }

            Response::redirect("/login", $request);
        }

        redirect("/");
    }

    public function destroy(): void
    {
        $this->sessionService->killSession();

        redirect("/");
    }
}