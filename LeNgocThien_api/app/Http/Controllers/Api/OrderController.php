<?php

namespace App\Http\Controllers\Api;
use App\Models\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /*lay danh sach*/
    public function index(){
        $orders = Order::all();
        return response()->json(['success'=>true,'message'=>"Tải dữ liệu thành công",'orders'=>$orders],200);
    }
    public function show($id)
    {

        $Order = Order::find($id);

        return response()->json(

            ['success' => true, 'message' => 'Tai du lieu thanh cong', 'orders' => $Order],

            200

        );
    }
    //Post- them store
    public function store(Request $request)
    {
        $Order = new Order();
        $Order->user_id = $request->user_id; 
        $Order->name = $request->name; 
        $Order->email = $request->email; 
        $Order->phone = $request->phone; 
        $Order->address = $request->address;
        $Order->note = $request->note;
        $Order->created_at = date('Y-m-d H:i:s');
        $Order->status = $request->status; //form
        $Order->delivery_gender = $request->delivery_gender; //form

        $Order->save(); //lưu vào Csdl
        return response()->json(
            ['success' => true, 'message' => 'Thanh cong', 'orders' => $Order],
            201
        );
    }
    //cap nhạt
    public function update(Request $request, $id)
    {

        $Order = Order::find($id);

        $Order->user_id = $request->user_id; 
        $Order->name = $request->name; 
        $Order->email = $request->email; 
        $Order->phone = $request->phone; 
        $Order->address = $request->address;
        $Order->note = $request->note;
        $Order->created_at = date('Y-m-d H:i:s');
        $Order->status = $request->status; //form
        $Order->delivery_gender = $request->delivery_gender; //form

        $Order->save(); //lưu vào Csdl

        return response()->json(

            ['success' => true, 'message' => 'Thanh cong', 'orders' => $Order],

            200

        );
    }
    //xoa
    public function destroy($id)
    {
        $Order = Order::find($id);
        if ($Order == null) {
            return response()->json(
                ['message' => 'Tai du lieu khong thanh cong', 'success' => false, 'orders' => null],
                404
            );
        }
        $Order->delete();
        return response()->json(['message' => 'thanh cong', 'success' => true, 'orders' => $Order], 200);

    }

}
