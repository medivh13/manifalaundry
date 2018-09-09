<?php

    namespace App\Http\Controllers\Transaction;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Models\Product;
    use App\Models\Order;
    use App\Models\DetailOrder;
    use DataTables;

    class MonitoringOrderController extends Controller
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
            $data['title'] = 'Monitoring Orders';

            return view('monitor-order.index', $data);
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
            $index = Order::orderBy('created_at','desc')->get();

            return DataTables::of($index)
            ->editColumn('code', function($index){
                return ucwords($index->code);
            })
            ->editColumn('customer', function($index){
                return ucwords($index->customer);
            })
            ->editColumn('status', function($index){
                if($index->tgl_selesai == null){
                    return '<span class="bg-danger">Dalam Proses</span>';
                }else{
                    return '<span class="bg-success">Selesai</span>';
                }
            })
            ->editColumn('created_at', function($index){
                return $index->created_at;
            })
            ->editColumn('tgl_selesai', function($index){
                if($index->tgl_selesai){
                    return $index->tgl_selesai;
                }else{
                    return '--:--:--';
                }
                
            })
            ->addColumn('action', function($index){
                $tag = '<center><a class="btn btn-primary btn-sm detail" href="'.route('monitoring-order.detail',['id' => $index->id]).'")><i class="fa fa-bars"></i><span class="tombol"> Detail</span></a>';
                $tag .= ' <a class="btn btn-success btn-sm hapus" idt="'.$index->id.'"")><i class="fa fa-check"></i><span class="tombol"> Selesai</span></a></center>';
                return $tag;
            })
            ->rawColumns(['action','status'])
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
            return view('monitor-order.detail', $data); 
        }
    }
