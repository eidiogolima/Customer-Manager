<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutenticacaoDoisPassos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /*    // ADF via e-mail para todos usuários que habilitarem essa verificação.
           if ($request->user() != null && $request->user()->autenticacao_dois_passos == 1) {

               $user = $request->user();

               $expires_in = Carbon::parse($user->email_verified_at);

               if ($expires_in->lessThan(now()->subDay())) {
                   if ($request->path() !== 'zs/adf-login') {
                       return redirect('/zs/adf-login');
                   }
               }
           }

           // Força o admin a realizar o ADF -> Autenticação duplo fator 
           if ($request->user() != null && $request->user()->id_tipo == 1 && $request->user()->autenticacao_dois_passos == 0) {
               if ($request->path() !== 'zs/adf') {
                   return redirect('/zs/adf');
               }
           } */

        if (
            $request->user() != null

            && $request->user()->autenticacao_dois_passos == 1
        ) {
            if ($request->session()->get('codigo2autenticator') != $request->user()->codigo_autenticacao) {

                Auth::guard('web')->logout();

                $request->session()->invalidate();

                $request->session()->regenerate();

                return redirect('/zs/google/auth');

            }
        }

        return $next($request);
    }

}
