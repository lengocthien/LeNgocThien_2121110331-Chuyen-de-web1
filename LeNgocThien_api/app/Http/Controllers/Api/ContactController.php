<?php

namespace App\Http\Controllers\Api;
use App\Models\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
     /*lay danh sach*/
     public function index(){
        $contacts = Contact::all();
        return response()->json(['success'=>true,'message'=>"Tải dữ liệu thành công",'contacts'=>$contacts],200);
    }
    public function show($id)
    {

        $Contact = Contact::find($id);

        return response()->json(

            ['success' => true, 'message' => 'Tải dữ liệu thành công', 'contact' => $Contact],

            200

        );
    }
    //Post- them store
    public function store(Request $request)
    {
        $Contact = new Contact();
        $Contact->user_id = $request->user_id; 
        $Contact->name = $request->name; 
        $Contact->email = $request->email; 
        $Contact->phone = $request->phone; 
        $Contact->title = $request->title; 
        $Contact->content = $request->content; 
        $Contact->replay_id = $request->replay_id; 
        $Contact->created_at = date('Y-m-d H:i:s');
        $Contact->created_by = 1;
        $Contact->status = $request->status; //form
        $Contact->save(); //lưu vào Csdl
        return response()->json(
            ['success' => true, 'message' => 'Tải dữ liệu thành công', 'contacts' => $Contact],
            201
        );
    }
    //Contact-update
    public function update(Request $request, $id)
    {

        $Contact = Contact::find($id);
        $Contact->user_id = $request->user_id; 
        $Contact->name = $request->name; 
        $Contact->email = $request->email; 
        $Contact->phone = $request->phone; 
        $Contact->title = $request->title; 
        $Contact->content = $request->content; 
        $Contact->replay_id = $request->replay_id; 
        $Contact->created_at = date('Y-m-d H:i:s');
        $Contact->created_by = 1;
        $Contact->status = $request->status; //form
        $Contact->save(); //lưu vào Csdl

        return response()->json(

            ['success' => true, 'message' => 'Tải dữ liệu thành công', 'contacts' => $Contact],

            200

        );
    }
    //xoa
    public function destroy($id)
    {
        $Contact = Contact::find($id);
        if ($Contact == null) {
            return response()->json(
                ['message' => 'Tai du lieu khong thanh cong', 'success' => false, 'contacts' => null],
                404
            );
        }
        $Contact->delete();
        return response()->json(['message' => 'Thanh cong', 'success' => true, 'contacts' => $Contact], 200);

    }
}
