<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserTenant;
use App\Models\Tenant;
use App\Services\AuthenticateTenantService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class AuthTenantController extends Controller
{

    public function __construct(AuthenticateTenantService $authenticateService)
    {

        $this->authenticateService = $authenticateService;

        $this->middleware('guest')->except('logout');
        $this->middleware('guest:tenant')->except('logout');
    }

    public function Login(Request $request)
    {

        try {
            $data = $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', Rules\Password::defaults()],
            ]);

            if (!$token = auth('tenant')->attempt($data)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $this->authenticateService->login($data, new UserTenant());

            return  $this->respondWithToken($token, $this->authenticateService->login($data));
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function Registrar(Request $request)
    {
        try {

            $data = $request->validate([

                'email'      => ['required', 'string', 'email', 'max:255', 'unique:users_tenant,email'],
                'password'   => ['required', 'confirmed', Rules\Password::defaults()],
                'tenant_id'  => ['required', 'string', 'max:255'],
                'nome'       => ['required', 'string', 'max:255'],
                'empresa'    => ['required', 'string', 'max:255'],
                "cnpf_cnpj"  => ['required', 'string', 'max:255'],
                "fantasia"   => ['required', 'string', 'max:255'],
                "logradouro" => ['required', 'string', 'max:255'],
                "numero"     => ['required', 'string', 'max:255'],
                "bairro"     => ['required', 'string', 'max:255'],
                "cidade"     => ['required', 'string', 'max:255'],
                "uf"         => ['required', 'string', 'max:255'],
                "cep"        => ['required', 'string', 'max:255'],
                "telefone1"  => ['required', 'string', 'max:255']
            ]);

            $tenant = new Tenant();
            $tenant->id         = $request->tenant_id;
            $tenant->empresa    = $request->empresa;
            $tenant->cnpf_cnpj  = $request->cnpf_cnpj;
            $tenant->fantasia   = $request->fantasia;
            $tenant->logradouro = $request->logradouro;
            $tenant->numero     = $request->numero;
            $tenant->bairro     = $request->bairro;
            $tenant->cidade     = $request->cidade;
            $tenant->uf         = $request->uf;
            $tenant->cep        = $request->cep;
            $tenant->telefone1  = $request->telefone1;

            $tenant->save();


            $this->authenticateService->register($data, new UserTenant());

            return response()->json($data);

        } catch (\Throwable $th) {
            return $th;
        }
    }

    protected function respondWithToken($token, $tenant_id)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('tenant')->factory()->getTTL() * 600,
            'tenant_id' => $tenant_id
        ]);
    }
}
