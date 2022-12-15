<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreUserRequest;
use DataTables;
use Hash;
use Validator;
use Illuminate\Support\Str;
class UsersController extends Controller
{
    public function export() 
    {
        $sdate = '2022-07-28';
        $edate = '2022-07-29';
        return Excel::download(new UsersExport($sdate,$edate), 'users.xlsx');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id','name','username','email','rank')->latest();
            return Datatables::of($data)->addIndexColumn()
           
                ->addColumn('rank',function($row){
                   if($row->rank==1){$rank="Administrator";}
                   if($row->rank==2){$rank="User";}
                    return $rank;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning edit">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger delete">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.setup.users');
    }
    public function profile()
    {
        return view('backend.setup.profile');
    }
    public function editProfile(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            //'email' => 'required|email|string|max:255',
            
        ]);

        //User::create($validateData);
        $data = User::find($request->id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->save();
        return response()->json(['success'=>'User saved successfully.']);
        
    }
    public function changePassword(Request $request)
    {
        $validateData = $request->validate([
            'currentPassword' => 'required|string|min:5',
            'password' => 'required|string|min:5|same:confirmPassword',
            'confirmPassword' => 'required|string|min:5',
        ]);
        $data = User::find($request->id);
        if(Hash::check($request->currentPassword, $data->password)){
            $data->password = Hash::make($request->password);
            $data->save();
            return response()->json(['success'=>'Change successfully.']);
        }   
        else{
            return response()->json(['error'=>'Sorry! Do not match current password.']);
           
        }
       
    }
    public function companyinfo()
    {
        return view('backend.setup.companyinfo');
    }
    public function themes()
    {
        return view('backend.setup.themes');
    }

    public function deleteuser($id)
    {
        User::find($id)->delete();
        return response()->json(['success'=>'Deleted successfully.']);
    }

    public function getuserdetail($id)
    {
        $data = User::find($id);
        return response()->json($data);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            //'email' => 'nullable|string|max:255',
            'rank' => 'required',
        ]);
        if($request->password!=""){
            $data = User::find($request->user_id);
            $data->name = $request->name;
            $data->username = $request->username;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);
            $data->rank = $request->rank;
            $data->update();
        }
        else{
            $data = User::find($request->user_id);
            $data->name = $request->name;
            $data->username = $request->username;
            $data->email = $request->email;
            $data->rank = $request->rank;
            $data->update();
        }
        return response()->json(['success'=>'User saved successfully.']);
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            //'email' => 'email|string|max:255',
            'phone' => 'required',
            'rank' => 'required',
            'password' => 'required|string|min:5|same:confirm-password',
        ]);

        //User::create($validateData);
        $data = new User;
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->rank = $request->rank;
        $data->phone = $request->phone;
        $data->save();
        return response()->json(['success'=>'User saved successfully.']);
    }

    public function project(Request $request){
        if ($request->ajax()) {
            $data = Project::select('id','project','deadline','status')->get();
            return Datatables::of($data)->addIndexColumn()
           
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-sm btn-warning edit">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn  btn-sm btn-danger delete">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.setup.project');
    }

    public function save_project(Request $request)
    {
        $validateData = $request->validate([
            'project' => 'required',
            'status' => 'required',
        ]);
        if($request->deadline==''){
            $date = '0000-00-00';
        }
        else{
            $date = $request->deadline;
        }
        $data = new Project;
        $data->project = $request->project;
        $data->deadline = $date;
        $data->status = $request->status;
        $data->save();
        return response()->json(['success'=>'Saved successfully.']);
    }

    public function deleteproject($id)
    {
        Project::find($id)->delete();
        return response()->json(['success'=>'Deleted successfully.']);
    }
    public function projectdetail($id)
    {
       $data = Project::find($id);
        return response()->json($data);
    }
    public function updateproject(Request $request)
    {
        $validateData = $request->validate([
            'projectname' => 'required',
            'deadline' => 'required',
            'status' => 'required',
        ]);
        $data = Project::find($request->id);
        $data->project = $request->projectname;
        $data->deadline = $request->deadline;
        $data->status = $request->status;
        $data->save();
        return response()->json(['success'=>'Saved successfully.']);
    }
    public function projectlist(Request $request){
        if ($request->ajax()) {
            $data = Project::select('id','project','deadline','status')->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('St',function($row){
                $status ="";
                   if($row->status=="Urgent"){$status="<span class='text-danger'>Urgent</span>";}
                   if($row->status=="Done"){$status="<span class='text-success'>Done</span>";}
                   if($row->status=="Normal"){$status="<span class=''>Normal</span>";}
                  
                    return $status;
                })
                ->rawColumns(['St'])
                ->make(true);
        }
        return view('backend.setup.projectlist');
    }
}
