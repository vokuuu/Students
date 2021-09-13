<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function Registr(Request $val)
    {
    	$mod = Validator::make($val->all(), [
    	'name' => 'required',
    	'last_name' => 'required',
    	'age' => 'required',
    	'login' => 'required',
    	'password' => 'required'
    	]);

    	if($mod->fails()) {
    		return response()->json($mod->errors());
    	}

    	$nmod = Student::create($val->all());
    	return response()->json('Вы успешно зарегистрировались');
    }

    public function Login(Request $val)
    {
    	$mod = Validator::make($val->all(), [
    	'login' => 'required',
    	'password' => 'required'
    	]);

    	if($mod->fails()) {
    		return response()->json($mod->errors());
    	}

    	if($nmod = Student::where('login', $val->login)->first() and $val->password == $nmod->password) {
    		$nmod->api_token = Str::random(10);
    		$nmod->save();
    		return response()->json('Вы успешно авторизовались. Ваш api_token:'.$nmod->api_token);
    	}
    	return response()->json('Логин или пароль введены неверно. Пожалуйста, попробуйте ещё раз');
    }

    public function Logout(Request $val)
    {
    	$mod = Student::where('api_token', $val->all())->first();
    	if ($mod) {
    		$mod->api_token = NULL;
    		$mod->save();
    		return response()->json('Вы вышли из своего аккаунта.');
    	}
    }


    public function getStud()
    {
    	return response()->json(Student::get());
    }

    public function addStud(Request $val)
    {
    	$mod = new Student;

    	$mod->name = $val->name;
    	$mod->last_name = $val->last_name;
    	$mod->age = $val->age;
    	$mod->login = $val->login;
    	$mod->password = $val->password;

    	if($mod->save()) {
    		return response()->json('Поле было успешно добавлено');
    	}
    	else {
    		return response()->json('Поле не добавлено');
    	}
    }

    public function updateStud(Request $val)
    {
    	$mod = Student::where('name', $val->name)->first();

    	$mod->password = $val->password;
    	$mod->save();
    	return response()->json('Данные были обновлены');
    }

    public function deletStud(Request $val)
    {
    	$mod = Student::where('name', $val->name)->first();
    	$mod->delete();
    	return response()->json('Поле успешно уданелно');
    }
}
