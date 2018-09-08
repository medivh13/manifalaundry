<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\DetailOrder;
use PDF;
use QRCode;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Order';
        $data['product'] = Product::all();
        $data['tanggal'] = justDay();
        $data['code'] = $this->codegen(justDay());
        return view('order.index', $data);
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
        // dd($request->product);
        $data['code'] = $request->code;
        $data['customer'] = $request->customer;
        $data['alamat'] = $request->alamat;
        $data['telp'] = $request->telp;
        $data['keterangan'] = $request->keterangan;
        $index= Order::create($data);

        //$this->dispatch(new SalesOrder($request));

        if($index){
          $orders= Order::where('code',$request->code)->first();

          foreach($request->product as $key=>$val){
            $detail = DetailOrder::insert([
                'order_id'=>$orders->id,
                'product_id'=>$val,
                'amount'=>$request->amount[$key]
            ]);
          }
        $pdf['total'] = 0;
        $temp = 0;
        $pdf['code'] = $request->code;
        $pdf['customer'] = $request->customer;
        $pdf['alamat'] = $request->alamat;
        $pdf['telp'] = $request->telp;
        $pdf['keterangan'] = $request->keterangan;
        foreach($request->product as $key=>$val){
            $product = Product::find($val);
            $pdf['product_name'][$key] = $product->name;
            $pdf['harga'][$key] = $product->harga;
            $pdf['amount'][$key] = $request->amount[$key];
            $temp = $temp + ($product->harga * $request->amount[$key]);
        }
        $pdf['total'] = $temp;

        // dd($pdf);
        
        $pdf = PDF::loadView('order.pdf', $pdf)->setWarnings(false)->setPaper('a5', 'portrait');
       
        return  $pdf->download($request->code.'.pdf');//->with('toastr', 'Order');
        // return redirect()->route('order.index')->with('toastr', 'Order');
        // return view('order.index',$pdf->download($request->code.'.pdf'))->with('toastr', 'Order');

    }else{

      return redirect()->route('order.index')->with('danger', 'Order'); 
  }
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
        //
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
        //
    }

    public function prodname($id){
        $data = Product::find($id);
        return response()->json($data);
    }

    public function codegen($date){
      $data = str_replace('-','',$date);

      $number = \DB::table('tb_order')
      ->select(
        \DB::raw('MAX(SUBSTRING(code, 13, 3)) as max'))
      ->where('code', 'LIKE','SO-'.$data.'%')->first()->max;

      $number = $number+1;

      if((int)$number>0){
          if(strlen($number)==1){
            $autono= 'SO-'.$data.'-00'.$number;
        }elseif(strlen($number)==2){
            $autono= 'SO-'.$data.'-0'.$number;
        }else{
            $autono= 'SO-'.$data.'-'.$number;
        };
          //dd($autono);exit();
          // return response()->json($autono);
        return $autono;

    }
}
}
