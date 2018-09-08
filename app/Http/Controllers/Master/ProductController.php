<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use DataTables;

class ProductController extends Controller
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
  $data['title'] = 'Service';

  return view('product.index', $data);
}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
  $data['title'] = 'New Service';
  return view('product.create', $data);
}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{
  $data = collect($request->all())
  ->except(['_token'])
  ->all();

  $product = Product::create($data);

  if($product){
    return redirect()->route('product.index')->with('toastr', 'Service');
  }else{
    return redirect()->route('product.index')->with('danger', 'Service');
  }
}

/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function show(Request $request)
{
  $index = Product::all();

  return DataTables::of($index)
  ->editColumn('name', function($index){
    return ucwords($index->name);
  })
  ->editColumn('harga', function($index){
    return formatPrice($index->harga);
  })
  ->addColumn('action', function($index){
    $tag = '<center><a class="btn btn-primary btn-sm ubah" href="'.route('product.edit',['id' => $index->id]).'")><i class="fa fa-pencil"></i> Edit</a>';
    $tag .= ' <a class="btn btn-danger btn-sm hapus" idt="'.$index->id.'"")><i class="fa fa-trash"></i> Delete</a></center>';
    return $tag;
  })
  ->make(true);
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{
  $data['title'] = 'Edit Service';
  $data['product'] = Product::find($id);
  return view('product.edit', $data);
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
    $data = collect($request->all())
      ->except(['_token'])
      ->all();
      $product = Product::find($id);
      if($product){
        $product->update($data);
        return redirect()->route('product.index')->with('update', 'Service');
      }else{
        return redirect()->route('product.index')->with('danger', 'Service');
      }
}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
  return Product::destroy($id);
}
}
