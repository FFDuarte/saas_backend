<?php

namespace App\Services;

use App\Models\UserApp;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthenticateUserAppService{

    public function __construct(private UserApp $user)  {

    }

    public function login($credentials){


            $user = $this->user->where('email', $credentials['email'])->first();

            if(!$user) throw new UnauthorizedHttpException("Invalid Credentials");


            if(!Hash::check($credentials['password'],$user->password)) throw new UnauthorizedHttpException("Invalid Credentials");

            auth('app')->login($user);

            return $user->tenant_id;

    }

    public function register($data){

        $data['password'] = bcrypt($data['password']);
        auth('app')->login($this->user->create($data));
    }
}

