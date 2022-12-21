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
    $jobs = Job::orderBy('created_at','desc')->get()->take(3);
    return view('main', compact('jobs'));
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

    Session::flash('message', 'Successfully Registered! Please Login');
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

    Session::flash('message', 'Successfully Registered! Please Login');
    return redirect('/login')->with('success', 'Registration Succesfull! Please Login');
})->middleware('cekHome');

Route::get('/listing', function(Request $request){
    $count = 0;
        if($request->has('search')) {
            $jobs = Job::where('title', 'like', '%'.$request->search.'%')->get();
            $count = Job::where('title', 'like', '%'.$request->search.'%')->count();
        } else {
            $jobs = Job::all();
            $count = Job::count();
        }


        return view('listing', compact('jobs', 'count'));
});

Route::get('/job/{id}',function($id){
    $jobs = Job::where('id', '=', $id)->get();
    return view('rawdetail', compact('jobs') );
});

Route::get('/details/fail', function(){
    Session::flash('message', 'Please Login First!');
    Session::flash('alert-class', 'alert-danger');
    return view('login');
});

Route::prefix('user')->middleware('cekUser')->group( function() {
    Route::get('/', function() {
        return redirect()->route("user-home");
    });

    Route::get('/home', function(){
        $jobs = Job::orderBy('created_at','desc')->get()->take(3);
        return view('userhome', compact('jobs'));
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
        $user = Users::where('id', '=', getAuthUser()->id)->first();
        return view('details', compact('jobs', 'user') );
    });

    Route::post('/doApply', function(Request $request){
        // dd($request);
        $users = Users::find($request->user_id);
        $status = ['status'=>0];
        $users->Jobs()->attach($request->job_id, $status);
        $log = [
            'message' => getAuthUser()->first_name . " ". getAuthUser()->last_name . " Successfully applied for " . $request->titles. ' with job id of ' . Job::count()
        ];
        ApplicationLog::create($log);
        return redirect()->back();
    });

    Route::get('/applications', function(Request $request){
        $users = Users::where('id', '=', getAuthUser()->id)->get();
        // $users = Users::all();
        // dd($jobs);
        // dd($jobs->Users()->wherePivot('job_id', $jobs->id));
        return view('userapplication', compact('users'));
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
        $jobs = Job::orderBy('created_at','desc')->get()->take(3);
        return view('companyhome', compact('jobs'));
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
        if($saldo->saldo < 50000){
            Session::flash('message', 'You do not have enough Balance!');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/company/addjob');

        }

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
        Session::flash('message', 'Successfully posted a Job!');
        return redirect('/company/jobs');

    });

    Route::get('/jobs', function(){
        $jobs = Job::where('company_id', '=', getAuthUser()->id)->get();
        return view('companyjobs', compact('jobs'));
    });

    Route::get('/jobs/edit/{id}', function($id){
        $job = Job::where('id', '=', $id)->first();
        return view('companyedit', compact('job'));
    });
    Route::get('/jobs/close/{id}', function($id){
        $job = Job::where('id', '=', $id)->first();
        $tempjob = $job;
        $job->delete();
        Session::flash('message', 'Successfully closed the job request for '. $tempjob->title . '!');
        $log = [
            'message' => getAuthUser()->name . " Successfully deleted " . $tempjob->title. ' with id ' . $tempjob->id
        ];
        JobLog::create($log);
        $jobs = Job::where('company_id', '=', getAuthUser()->id)->get();
        return view('companyjobs', compact('jobs'));
    });

    Route::post('/jobs/doEdit', function(Request $request){
        $job = Job::where('id', '=', $request->job_id)->first();
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'location'=> 'required',
            'type_id'=> 'required|numeric',
        ]);
        // $job = $validatedData;
        $job->title = $request->title;
        $job->description = $request->description;
        $job->min = $request->min;
        $job->max = $request->max;
        $job->location = $request->location;
        $job->type_id = $request->type_id;
        $job->save();

        $log = [
            'message' => getAuthUser()->name . " Successfully updated " . $request->title. ' with id ' . $request->job_id
        ];
        JobLog::create($log);
        return redirect('/company/jobs')->with('message', 'Job has been successfully updated');
    });

    Route::get('applications', function(Request $request){
        $jobs = Job::where('company_id', '=', getAuthUser()->id)->get();
        // $users = Users::all();
        // dd($jobs);
        // dd($jobs->Users()->wherePivot('job_id', $jobs->id));
        return view('companyapplications', compact('jobs'));
    });

    Route::get('/plan', function(Request $request){
        $jobs = Job::where('id', '=', $request->id1)->first();
        $jobs->Users()->updateExistingPivot($request->id2, ['status' => 1]);
        Session::flash('message', 'Successfully planned an interview!');
        return redirect('/company/applications');
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
