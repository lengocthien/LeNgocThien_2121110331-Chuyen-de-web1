<?php

namespace App\Http\Controllers\Api;
use App\Models\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
     /*lay danh sach*/
     public function index(){
        $menus = Menu::all();
        return response()->json(['success'=>true,'message'=>"Tải dữ liệu thành công",'menus'=>$menus],200);
    }
    public function show($id)
    {

        $menu = menu::find($id);

        return response()->json(

            ['success' => true, 'message' => 'tai du lieu thanh cong', 'menu' => $menu],

            200

        );
    }
    //Post- them store
    public function store(Request $request)
    {
        $menu = new menu();
        $menu->name = $request->name; 
        $menu->link = $request->link;
        $menu->table_id = $request->table_id;
        $menu->type = $request->type;
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->created_by = 1;
        $menu->status = $request->status;
        $menu->parent_id = $request->parent_id; //form
        $menu->sort_order = $request->sort_order; //form
        $menu->position = $request->position; 

        $menu->save(); //lưu vào Csdl
        return response()->json(
            ['success' => true, 'message' => 'Thanh cong', 'menus' => $menu],
            201
        );
    }
    //cap nhạt
    public function update(Request $request, $id)
    {

        $menu = menu::find($id);
        $menu->name = $request->name; 
        $menu->link = $request->link;
        $menu->table_id = $request->table_id;
        $menu->type = $request->type;
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->created_by = 1;
        $menu->status = $request->status; //form
        $menu->parent_id = $request->parent_id;
        $menu->sort_order = $request->sort_order; //form
        $menu->position = $request->position; 
        $menu->save(); //lưu vào Csdl
        return response()->json(

            ['success' => true, 'message' => 'Thanh cong', 'menus' => $menu],

            200

        );
    }
    //xoa
    public function destroy($id)
    {
        $menu = menu::find($id);
        if ($menu == null) {
            return response()->json(
                ['message' => 'Tai du lieu khong thanh cong', 'success' => false, 'menus' => null],
                404
            );
        }
        $menu->delete();
        return response()->json(['message' => 'thành công', 'success' => true, 'menus' => $menu], 200);

    }

    public function menu_list($position, $parent_id = 0)
    {
        $args = [
            ['position', '=', $position],
            ['parent_id', '=', $parent_id],
            ['status', '=', 1]
        ];
        $menus = Menu::where($args)
            ->orderBy('sort_order', 'ASC')
            ->get();
        if(count($menus))
            {
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Tải dữ liệu thành công',
                        'menus' => $menus
                    ],
                    200
                );
            }
        else{
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Khong tim thay du lieu',
                    'menus' => null
                ],
                404
            );
        }
        
    }

}
