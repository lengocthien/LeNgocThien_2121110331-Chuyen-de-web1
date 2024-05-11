<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Str;


class UserController extends Controller
{
    /*lay danh sach*/
  public function index(){
    $users = User::all();
    return response()->json(['success'=>true,'message'=>"Tải dữ liệu thành công",'users'=>$users],200);
}

public function show($id)
{

    $User = User::find($id);

    return response()->json(

        ['success' => true, 'message' => 'tai du lieu thanh cong', 'user' => $User],

        200

    );
}
//Post- them store
public function store(Request $request)
{
    $User = new User();
    $User->name = $request->name; 
    $User->email = $request->email; 
    $User->phone = $request->phone; 
    $files = $request->image;
    if ($files != null) {
        $extension = $files->getClientOriginalExtension();
        if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
            $filename = $User->name . '.' . $extension;
            $User->image = $filename;
            $files->move(public_path('images/user'), $filename);
        }
    }
    $User->username = $request->username; 
    $User->password = $request->password; 
    $User->address = $request->address; 
    $User->roles = $request->roles; 
    $User->created_at = date('Y-m-d H:i:s');
    $User->created_by = 1;
    $User->status = $request->status; //form
    $User->save(); //lưu vào Csdl
    return response()->json(
        ['success' => true, 'message' => 'Thanh cong', 'users' => $User],
        201
    );
}
//User-update
public function update(Request $request, $id)
{

    $User = User::find($id);
    $User->name = $request->name; 
    $User->email = $request->email; 
    $User->phone = $request->phone; 
    $files = $request->image;
    if ($files != null) {
        $extension = $files->getClientOriginalExtension();
        if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
            $filename = $User->name . '.' . $extension;
            $User->image = $filename;
            $files->move(public_path('images/user'), $filename);
        }
    }
    $User->username = $request->username; 
    $User->password = $request->password; 
    $User->address = $request->address; 
    $User->roles = $request->roles; 
    $User->created_at = date('Y-m-d H:i:s');
    $User->created_by = 1;
    $User->status = $request->status; //form
    $User->save(); //lưu vào Csdl

    return response()->json(

        ['success' => true, 'message' => 'Thanh cong', 'users' => $User],

        200

    );
}
//xoa
public function destroy($id)
{
    $User = User::find($id);
    if ($User == null) {
        return response()->json(
            ['message' => 'Tai du lieu khong thanh cong', 'success' => false, 'users' => null],
            404
        );
    }
    $User->delete();
    return response()->json(['message' => 'Thanh cong', 'success' => true, 'users' => $User], 200);

}
}
