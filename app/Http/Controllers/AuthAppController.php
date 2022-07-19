<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserApp;
use App\Services\AuthenticateUserAppService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class AuthAppController extends Controller
{

    public function __construct(AuthenticateUserAppService $authenticateService)  {

        $this->authenticateService = $authenticateService;

        $this->middleware('guest')->except('logout');
        $this->middleware('guest:app')->except('logout');

    }

    public function Login( Request $request)
    {

        try {
            $data = $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', Rules\Password::defaults()],
            ]);

            if (! $token = auth('app')->attempt($data)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $this->authenticateService->login($data, new UserApp());

            return  $this->respondWithToken($token, $this->authenticateService->login($data));

        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function Registrar(Request $request )
    {
        try {

            $data = $request->validate([
                'nome'    => ['required', 'string', 'max:255'],
                'cpf'     => ['required', 'string', 'max:255'],
                'celular' => ['required', 'string', 'max:255'],
                'email'   => ['required', 'string', 'email', 'max:255', 'unique:users_app,email'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $this->authenticateService->register($data, new UserApp());

            return $data;

        } catch (\Throwable $th) {
           return $th;
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('app')->factory()->getTTL() * 60
        ]);
    }




}
