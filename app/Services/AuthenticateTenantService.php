<?php

namespace App\Services;

use App\Models\UserTenant;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthenticateTenantService{

    public function __construct(private UserTenant $user)  {

    }

    public function login($credentials){


            $user = $this->user->where('email', $credentials['email'])->first();

            if(!$user) throw new UnauthorizedHttpException("Invalid Credentials");


            if(!Hash::check($credentials['password'],$user->password)) throw new UnauthorizedHttpException("Invalid Credentials");

            auth('tenant')->login($user);

            return $user->tenant_id;

    }

    public function register($data){

        $data['password'] = bcrypt($data['password']);
        auth('tenant')->login($this->user->create($data));
    }
}

