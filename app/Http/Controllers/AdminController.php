<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Record;
use App\Models\Event;
use App\Http\Requests\StoreUserRequest;
use DataTables;
use Hash;
use Cookie;
class AdminController extends Controller
{
    public function systemlogin()
    {
        return view('backend.login');
    }
    public function login(Request $request)
    {
       $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            if($request->has('remember'))
            {
                Cookie::queue('username', $request->username,43200);
                Cookie::queue('password', $request->password,43200);
            }
            else{
                Cookie::queue('username', $request->username,-43200);
                Cookie::queue('password', $request->password,-43200);
            }
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
        }
        // else{
        //   return redirect('/'); 
        // }
    return back()->withErrors([
            'username' => 'The provided user do not match our records.',
        ])->onlyInput('username');
       
    }
    public function dashboard()
    {
        
        $date =date('Y-m-d');
        $users = User::all();
        $project = Project::all();
        if(Auth::user()->rank==1){
            //$records = Record::where('date',date('Y-m-d'))->get();
            $records = Record::join('users','record.usr_id','=','users.id')
                        //->where('record.date',$date)
                        ->orderBy('record.id','desc')
                        ->get(['record.*','users.name as developer']);
        }               
        if(Auth::user()->rank==2){
            $uid = Auth::user()->id;
            $records = Record::join('users','record.usr_id','=','users.id')
                        //->where('record.date',$date)
                        ->orderBy('record.id','desc')
                        ->where('record.usr_id',$uid)
                        ->get(['record.*','users.name as developer']);
            //$records = Record::where('usr_id',$uid)->where('date',date('Y-m-d'))->get();
        }
        return view('backend.dashboard',['users'=>$users,'project'=>$project,'records'=>$records]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
