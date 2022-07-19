<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserAdmin;
use App\Services\AuthenticateAdminService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class AuthAdminController extends Controller
{

    public function __construct(AuthenticateAdminService $authenticateService)  {

        $this->authenticateService = $authenticateService;

        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');

    }

    public function Login( Request $request)
    {

        try {
            $data = $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', Rules\Password::defaults()],
            ]);

            if (! $token = auth('admin')->attempt($data)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $this->authenticateService->login($data, new UserAdmin());

            return  $this->respondWithToken($token);

        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function Registrar(Request $request )
    {
        try {



            $this->validate($request,[
                'nome' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users_admin,email'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);



            $this->authenticateService->register($request->all(), new UserAdmin());

            return "Admin: " . $request->name;

        } catch (\Throwable $th) {
           return $th;
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60 ,
        ]);
    }




}
