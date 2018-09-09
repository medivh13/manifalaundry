<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DataTables;
use DB;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index()
  {
    $data['title'] = 'Users';

    return view('user.index', $data);
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
    if($request->id){
      if($request->password){
        $validatedData = $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:6|confirmed',
        ]);
        if($validatedData){
          $index= User::where('id',$request->id)
          ->update(['name'=>$request->name,
          'email'=>$request->email,
          'password'=>Hash::make($request->password)]);
        }
      }else{
        $index= User::where('id',$request->id)
        ->update(['name'=>$request->name,
        'email'=>$request->email]);
      }
    }else{
      $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
      ]);
      if($validatedData){
        $index= User::insert(['name'=>$request->name,
        'email'=>$request->email,
        'password' => Hash::make($request->password)]);
      }
    }
    return response()->json($index);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show(Request $request)
  {
    if($request->ajax()){
      DB::statement(\DB::raw('set @nomor = 0'));
      $index = User::select([
        DB::raw('@nomor := @nomor + 1 as no'),
        'id',
        'name',
        'email'
        ])->get();

        return DataTables::of($index)
        ->editColumn('name', function($index){
          return ucwords($index->name);
        })
        ->addColumn('action', function($index){
          $tag = "<center><a class='btn btn-primary btn-sm ubah' idt='".$index->id."')><i class='fa fa-pencil'></i> <span class='tombol'> Edit</span></a> ";
          $tag .= "<a class='btn btn-danger btn-sm hapus' idt='".$index->id."')><i class='fa fa-trash'></i> <span class='tombol'> Delete</span></a></center>";
          return $tag;
        })
        ->make(true);
      }
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
      return User::find($id);
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

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
      $index= User::destroy($id);
      return response()->json($index);
    }
  }
