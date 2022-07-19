<?php

namespace App\Services;

use App\Models\UserAdmin;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthenticateAdminService{

    public function __construct(private UserAdmin $user)  {

    }

    public function login($credentials){

            $user = $this->user->where('email', $credentials['email'])->first();

            if(!$user) throw new UnauthorizedHttpException("Invalid Credentials");


            if(!Hash::check($credentials['password'],$user->password)) throw new UnauthorizedHttpException("Invalid Credentials");

            auth('admin')->login($user);

            return $user;

    }

    public function register($data){

        $data['password'] = bcrypt($data['password']);
        auth('admin')->login($this->user->create($data));
    }
}

