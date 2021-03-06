<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\DetailOrder;
use DataTables;
use PDF;

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

    public function index(Request $request)
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
        dd($request->all());
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
                    $tag = '<center><a class="btn btn-primary btn-sm detail" href="'.route('pay.detail',['id' => $index->id]).'")><i class="fa fa-bars"></i><span class="tombol"> Detail</span></a>';
                    $tag .= ' <a class="btn btn-success btn-sm selesai" href="'.route('pay.cetak',['id' => $index->id]).'"><i class="fa fa-print"></i><span class="tombol"> Cetak</span></a></center>';
                    // $tag .= ' <a class="btn btn-success btn-sm cetak" idt="'.$index->id.'"><i class="fa fa-print"></i><span class="tombol"> Cetak</span></a></center>';
                    return $tag;
                }else{
                    $tag = '<center><a class="btn btn-primary btn-sm detail" href="'.route('pay.detail',['id' => $index->id]).'"><i class="fa fa-bars"></i><span class="tombol"> Detail</span></a>';
                    $tag .= ' <a class="btn btn-warning btn-sm selesai" href="'.route('pay.bayar',['id' => $index->id]).'"><i class="fa fa-dollar"></i><span class="tombol"> Bayar</span></a></center>';
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
        // dd($request->all());
        $data = collect($request->all())
        ->except(['_token'])
        ->merge([
            'tgl_bayar' => thisday(),
            // 
            'status_bayar' => 1
        ])
        ->all();
        // dd($data);
        $bayar = Order::find($id);
        // dd($bayar);
        $index = $bayar->update($data);
        if($index){
            // $bayar->update($data);
            return redirect()->route('pay.index')->with('update', 'Pembayaran');
        }else{
            return redirect()->route('pay.index')->with('danger', 'Pembayaran');
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

    public function cetak($id){
        $order = Order::find($id);
        $detail = DetailOrder::where('order_id',$id)->get();
        // dd($detail);
        $data['code'] = $order->code;
        $data['tgl_bayar'] = $order->tgl_bayar;
        $data['jml_bayar'] = $order->jml_bayar;
        $data['jml_kembali'] = $order->jml_kembali;
        $data['total_biaya'] = $order->pemasukan;

        foreach($detail as $key=>$val){
            $product = Product::find($val->product_id);

            $data['product_name'][$key] = $product->name;
            $data['product_harga'][$key] = $product->harga;
            $data['jumlah'][$key] = $val->amount;
        }
        // dd($data);
        // return view('pay.pdf',$data);
        $pdf = PDF::loadView('pay.pdf', $data)->setWarnings(false)->setPaper('a6', 'portrait');
       
        return  $pdf->download('struck_'.$order->code.'.pdf');

    }
}
