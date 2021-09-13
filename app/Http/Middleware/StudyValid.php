<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Student;

class StudyValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $val, Closure $next)
    {
        if(!$val->api_token) {
            return response()->json('api_token введен неверно');
        }
        if(!Student::where('api_token', $val->api_token)->first())
        {
            return response()->json('Такого пользователя не существует');
        }
        return $next($val);
    }
}
