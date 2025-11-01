<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // Mostra messaggio di errore nella prossima richiesta
            session()->flash('error', 'Ti devi autenticare per accedere a questa pagina.');
            return route('login');
        }
    }
}
