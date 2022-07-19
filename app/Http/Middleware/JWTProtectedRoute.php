<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserTenant;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class JWTProtectedRoute extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            /**
             * Pega dados do token jwt para validar permissões de usário
             */
            $token_role = $this->auth->parseToken()->getClaim('role');
            $tenant_id_permission = $this->auth->parseToken()->getClaim('tenant_id');
            $email_permission = $this->auth->parseToken()->getClaim('email');

            /**
             * Verifica tenant apenas se acessar rotas de tenant
             */
            if ($tenant_id_permission) {
                $user = new UserTenant();

                $dados_user = $user->where('email', '=', $email_permission)->first();

                if ($tenant_id_permission != $dados_user->tenant_id) {
                    throw new UnauthorizedHttpException('Usuário sem permissão');
                }
            }

            if ($token_role != $role) {
                throw new UnauthorizedHttpException('Usuário sem permissão');
            }

        } catch (\Exception $e) {

            if ($e instanceof UnauthorizedHttpException) {
                return response()->json(['status' => 'Usuário sem permissão']);
            }


            if ($e instanceof TokenInvalidException) {
                return response()->json(['status' => 'Token is Invalid']);
            } else if ($e instanceof TokenExpiredException) {
                return response()->json(['status' => 'Token is Expired']);
            } else {
                return response()->json(['status' => 'Authorization Token not found']);
            }
        }

        return $next($request);
    }
}
