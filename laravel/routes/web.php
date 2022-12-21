<?php

use App\Models\ApplicationLog;
use Illuminate\Support\Facades\Route;
use App\Models\Users;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobLog;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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

Route::get('/', function (){
    return view('main');
})->middleware('cekHome');

Route::get('/login', function () {
    return view('login');
})->middleware('cekHome');

Route::post('/doLogin', function (Request $request) {
    $credential = [
        'email' => $request->email,
        'password' => $request->password
    ];
    if($request->role == 1){
        if(Auth::guard('web')->attempt($credential)){
            return redirect('/');
        }else{
            echo 'salah';
        }
    }else if($request->role == 2){
        if(Auth::guard('company')->attempt($credential)){
            return redirect('/');
        }else{
            echo 'salah';
        }
    }
})->middleware('cekHome');

Route::get('/doLogout', function(Request $req){
    if(aldLogin()){

    }
    if(Auth::guard('web')->check()){
        Auth::guard('web')->logout();
    }
    if(Auth::guard('company')->check()){
        Auth::guard('company')->logout();
    }
    return redirect('/');
});

Route::get('/register', function(){
    return view('registeruser');
})->middleware('cekHome');

Route::post('/register/doRegister', function(Request $request){
    $validatedData = $request->validate([
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'email' => 'required|unique:users',
        'password' => 'required|confirmed',
        'dob' => 'required|date',
        'gender'=> 'required',
        'number'=> 'required|numeric',
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);

    Users::create($validatedData);
    return redirect('/login')->with('success', 'Registration Succesfull! Please Login');
})->middleware('cekHome');

Route::get('/registerc', function(){
    return view('registercompany');
})->middleware('cekHome');

Route::post('/registerc/doRegister', function(Request $request){
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|unique:companies',
        'password' => 'required|confirmed',
        'address' => 'required',
        'type'=> 'required',
        'website'=> 'required',
        'number' => 'required|numeric',
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);

    Company::create($validatedData);
    return redirect('/login')->with('success', 'Registration Succesfull! Please Login');
})->middleware('cekHome');

Route::prefix('user')->middleware('cekUser')->group( function() {
    Route::get('/', function() {
        return redirect()->route("user-home");
    });

    Route::get('/home', function(){
        return view('userhome');
    })->name('user-home');

    Route::get('/listing',function(Request $request){
        $count = 0;
        if($request->has('search')) {
            $jobs = Job::where('title', 'like', '%'.$request->search.'%')->get();
            $count = Job::where('title', 'like', '%'.$request->search.'%')->count();
        } else {
            $jobs = Job::all();
            $count = Job::count();
        }


        return view('userlisting', compact('jobs', 'count'));
    });

    Route::get('/job/{id}',function($id){
        $jobs = Job::where('id', '=', $id)->get();
        return view('details', compact('jobs') );
    });

    Route::post('/doApply', function(Request $request){
        // dd($request);
        $users = Users::find($request->user_id);
        $status = ['status'=>0];
        $users->Jobs()->attach($status);
        $log = [
            'message' => getAuthUser()->first_name . " ". getAuthUser()->last_name . " Successfully applied for " . $request->titles. ' with job id of ' . Job::count()
        ];
        ApplicationLog::create($log);
        return redirect()->back();
    });

    Route::prefix('profile')->group( function() {
        Route::get('/',function(){
            $user = Users::where('id', '=', getAuthUser()->id)->get();
            return view('userprofile', compact('user'));
        });
        Route::post('/doUpload',function(Request $request){
            $request->validate(
                [
                    'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg'
                ]
            );

            $file = $request->file('photo') ;
            $fileName = getAuthUser()->id . ".png";
            $destinationPath = public_path().'/img/icon' ;
            $file->move($destinationPath,$fileName);
            $user = Users::where('id', '=', getAuthUser()->id)->first();
            $user->image = $fileName;
            $user->save();
            return redirect()->back();
        });
        Route::post('/addCV',function(Request $request){
            $request->validate(
                [
                    'cv' => 'required|file|mimes:pdf'
                ]
            );

            $file = $request->file('cv') ;
            $fileName = getAuthUser()->id . ".pdf";
            $destinationPath = public_path().'/cv' ;
            $file->move($destinationPath,$fileName);
            $user = Users::where('id', '=', getAuthUser()->id)->first();
            $user->cv = $fileName;
            $user->save();

            return redirect()->back();
        });
        Route::get('/download', function(){

            if (file_exists(public_path("/cv/" . getAuthUser()->id . ".pdf"))){
                $file = public_path()."/cv/" . getAuthUser()->id . ".pdf";
                $headers = array('Content-Type: application/pdf',);
                return Response::download($file, getAuthUser()->first_name . ".pdf",$headers);

            }else{
                Session::flash('message', 'You have not uploaded a CV Yet!');
                Session::flash('alert-class', 'alert-danger');
                return redirect('/user/profile');
            }

        });
    });
});

Route::prefix('company')->middleware('cekCompany')->group( function() {
    Route::get('/', function() {
        return redirect()->route("company-home");
    });

    Route::get('/home', function(){
        return view('companyhome');
    })->name('company-home');

    Route::get('/addjob', function(){
        return view('addjob');
    });

    Route::post('/doAddJob', function(Request $request){
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'location'=> 'required',
            'type_id'=> 'required|numeric',
            'company_id' => 'required|numeric',
        ]);
        Job::create($validatedData);

        $log = [
            'message' => getAuthUser()->name . " Successfully added " . $request->title. ' with id ' . Job::count()
        ];
        JobLog::create($log);
        $saldo = Company::where('id', '=', getAuthUser()->id)->first();

        $saldo = (int)$saldo->saldo - 50000;

        $company = Company::where('id', '=', getAuthUser()->id)->first();
        $company->saldo = $saldo;
        $company->save();

        Transaction::create(
            [
                'type' => 'Company Posted a Job',
                'amount' => 50000,
                'company_id' => getAuthUser()->id
            ]
        );
        return redirect('/company/addjob')->with('success', 'Job has been successfully posted');

    });



    Route::prefix('profile')->group( function() {
        Route::get('/',function(){
            $company = Company::where('id', '=', getAuthUser()->id)->get();
            return view('companyprofile', compact('company'));
        });
        Route::post('/doUpload',function(Request $request){
            $request->validate(
                [
                    'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg'
                ]
            );

            $file = $request->file('photo') ;
            $fileName = getAuthUser()->id . ".png";
            $destinationPath = public_path().'/img/icon' ;
            $file->move($destinationPath,$fileName);
            $user = Company::where('id', '=', getAuthUser()->id)->first();
            $user->image = $fileName;
            $user->save();
            return redirect()->back();
        });
        Route::post('/topup', function(Request $request){
            $request->validate(
                [
                    'saldo' => 'required|numeric',
                ]
            );

            $saldo = Company::where('id', '=', getAuthUser()->id)->first();

            $saldo = (int)$saldo->saldo + (int)$request->saldo;

            $company = Company::where('id', '=', getAuthUser()->id)->first();
            $company->saldo = $saldo;
            $company->save();

            Transaction::create(
                [
                    'type' => 'Top Up Balance Company',
                    'amount' => $request->saldo,
                    'company_id' => getAuthUser()->id
                ]
            );
            return redirect()->back();
        });
    });
});
