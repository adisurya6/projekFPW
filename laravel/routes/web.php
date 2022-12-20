<?php

use Illuminate\Support\Facades\Route;
use App\Models\Users;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/doLogin', function (Request $request) {
    $credential = [
        'email' => $request->email,
        'password' => $request->password
    ];
    if($request->role == 1){
        if(Auth::guard('web')->attempt($credential)){
            dd(Auth::guard('web')->user());
        }else{
            echo 'salah';
        }
    }
});

Route::get('/register', function(){
    return view('registeruser');
});

Route::post('/register/doRegister', function(Request $request){
    $validatedData = $request->validate([
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'email' => 'required|unique:users',
        'password' => 'required|confirmed',
        'dob' => 'required|date',
        'gender'=> 'required',
        'number'=> 'required',
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);

    Users::create($validatedData);
    return redirect('/login')->with('success', 'Registration Succesfull! Please Login');
});

Route::get('/registerc', function(){
    return view('registercompany');
});

Route::post('/registerc/doRegister', function(Request $request){
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|unique:companies',
        'password' => 'required',
        'address' => 'required',
        'type'=> 'required',
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);

    Users::create($validatedData);
});

Route::prefix('user')->group( function() {
    Route::get('/', function() {
        return redirect()->route("user-home");
    });

    Route::get('/home', function(){
        return view('userhome');
    })->name('user-home');

    Route::get('/listing',function(){
        return view('userlisting');
    });

    Route::get('/job/{id}',function(){
        return view('details');
    });

    Route::get('/profile',function(){
        return view('userprofile');
    });
});

Route::prefix('company')->group( function() {
    Route::get('/', function() {
        return redirect()->route("company-home");
    });

    Route::get('/home', function(){
        return view('companyhome');
    })->name('company-home');

    Route::get('/addjob', function(){
        return view('addjob');
    })->name('add-job');

    Route::get('/profile',function(){
        return view('companyprofile');
    });
});