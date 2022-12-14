<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Record;
use App\Models\Project;
use App\Http\Requests\StoreUserRequest;
use DataTables;
use Hash;
use Validator;
use Illuminate\Support\Str;
class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'project' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        $data = new Record;
        $data->usr_id = $request->user_id;
        $data->project_title = $request->project;
        $data->description = $request->description;
        $data->date = $request->date;
        $data->status = $request->status;
        $data->save();
        return response()->json(['success'=>'Save successfully.']);
    }
    public function me(Request $request, $user_id=null){
        $project = Project::all();
                 
        if ($request->ajax()) {
            if($user_id!=null){
                //$records = Record::where('date',date('Y-m-d'))->get();
                $records = Record::join('users','record.usr_id','=','users.id')
                            ->where('record.usr_id',$user_id)
                            ->orderBy('record.id','desc')
                            ->get(['record.*','users.name as developer']);
            }else{
                //if(Auth::user()->rank==2){
                    $uid = Auth::user()->id;
                    $records = Record::join('users','record.usr_id','=','users.id')
                                ->where('record.usr_id',$uid)
                                ->orderBy('record.id','desc')
                                ->get(['record.*','users.name as developer']);
                    //$records = Record::where('usr_id',$uid)->where('date',date('Y-m-d'))->get();
                //}
            } 
            return Datatables::of($records)->addIndexColumn()
                 ->addColumn('created', function($row){
                    $date = date('d-M-Y', strtotime($row->created_at));
                    return $date;
                    })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm edit">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm delete">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['created','action'])
                ->make(true);
        }
        return view('backend.record',['project'=>$project]);
    }
   
    public function recorddetail($id){
        $data = Record::find($id);
        return response()->json($data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function updaterecord(Request $request)
    {
        $validateData = $request->validate([
            'project' => 'required',
            'description' => 'required',
            'status' => 'required',
            'date' => 'required',
        ]);
        $data = Record::find($request->id);
        $data->project_title = $request->project;
        $data->description = $request->description;
        $data->date = $request->date;
        $data->status = $request->status;
        $data->save();
        return response()->json(['success'=>'Save successfully.']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleterecord($id)
    {
        Record::find($id)->delete();
        return response()->json(['success'=>'Deleted successfully.']);
    }
}
