<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\DetailOrder;
use DataTables;

class PayController extends Controller
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
        $data['title'] = 'Pembayaran';
        
        return view('pay.index', $data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $index = Order::orderBy('created_at','asc')->whereNotNull('tgl_selesai')->get();

        return DataTables::of($index)
            ->editColumn('code', function($index){
                return ucwords($index->code);
            })
            ->editColumn('customer', function($index){
                return ucwords($index->customer);
            })
            ->editColumn('created_at', function($index){
                return $index->created_at;
            })
            ->editColumn('tgl_selesai', function($index){
                return $index->tgl_selesai; 
            })
            ->addColumn('action', function($index){
                if($index->status_bayar){
                    $tag = '<center><a class="btn btn-primary btn-sm detail" href="'.route('pay.detail',['id' => $index->id]).'")><i class="fa fa-bars"></i><span class="tombol"> Detail</span></a></center>';
                    return $tag;
                }else{
                    $tag = '<center><a class="btn btn-primary btn-sm detail" href="'.route('pay.detail',['id' => $index->id]).'"><i class="fa fa-bars"></i><span class="tombol"> Detail</span></a>';
                    $tag .= ' <a class="btn btn-success btn-sm selesai" href="'.route('pay.bayar',['id' => $index->id]).'"><i class="fa fa-print"></i><span class="tombol"> Bayar</span></a></center>';
                    return $tag;
                }
                
            })
            ->rawColumns(['action'])
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

    public function detail($id){
            //dd($id);
        $data['title'] = 'Detail Order';
        $order = Order::find($id);
            // dd($order);
        $data['total'] = 0;
        $temp = 0;
        $data['code'] = $order->code;
        $data['customer'] = $order->customer;
        $data['alamat'] = $order->alamat;
        $data['telp'] = $order->telp;
        $data['keterangan'] = $order->keterangan;

        $detail = DetailOrder::where('order_id',$order->id)->get();

        foreach($detail as $key=>$val){
            $product_id[$key] = $val->product_id;
            $amount[$key] = $val->amount;
        }

        foreach($product_id as $key=>$val){
            $product = Product::find($val);
            $data['product'][$key] = $product->name;
            $data['harga'][$key] = $product->harga;
            $data['amount'][$key] = $amount[$key];
            $temp = $temp + ($product->harga * $amount[$key]);
        }
        $data['total'] = $temp;
            // dd($data);
        return view('pay.detail', $data); 
    }

    public function bayar($id){
            //dd($id);
        $data['title'] = 'Payment Order';
        $order = Order::find($id);
        $data ['id'] = $order->id;
            // dd($order);
        $data['total'] = 0;
        $temp = 0;
        $data['code'] = $order->code;
        $data['customer'] = $order->customer;
        $data['alamat'] = $order->alamat;
        $data['telp'] = $order->telp;
        $data['keterangan'] = $order->keterangan;

        $detail = DetailOrder::where('order_id',$order->id)->get();
        
        foreach($detail as $key=>$val){
            $product_id[$key] = $val->product_id;
            $amount[$key] = $val->amount;
        }

        foreach($product_id as $key=>$val){
            $product = Product::find($val);
            $data['product'][$key] = $product->name;
            $data['harga'][$key] = $product->harga;
            $data['amount'][$key] = $amount[$key];
            $temp = $temp + ($product->harga * $amount[$key]);
        }
        $data['total'] = $temp;
            // dd($data);
        return view('pay.bayar', $data); 
    }
}
