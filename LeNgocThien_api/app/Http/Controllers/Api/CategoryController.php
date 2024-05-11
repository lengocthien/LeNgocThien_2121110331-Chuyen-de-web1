<?php

namespace App\Http\Controllers\Api;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Str;


class CategoryController extends Controller
{
     /*lay danh sach*/
     public function index(){
        $categorys = Category::all();
        return response()->json(['success'=>true,'message'=>"Tải dữ liệu thành công",'categorys'=>$categorys],200);
    }

    /*lay bang id -> chi tiet */
    public function show($id){
        if(is_numeric($id)){
            $category = Category::findOrFail($id);
        }
        else{
            $category = Category::where('slug','=',$id)->first();
        }
        if ($category==null){
            return response()->json(
                ['success' => false, 'message' => 'Tải dữ liệu không thành công', 'category' => null],404
            );
        }
        return response()->json(['success'=>true,'message'=>"Tải dữ liệu thành công",'category'=>$category],200);
    }

    /* them */
    public function store(Request $request){
        $category = new Category();
        $category->name = $request->name; //form
        $category->slug = Str::of($request->name)->slug('-');
        $files = $request->image;
        if ($files != null) {
            $extension = $files->getClientOriginalExtension();
            if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                $filename = $category->slug . '.' . $extension;
                $category->image = $filename;
                $files->move(public_path('images/category'), $filename);
            }
        }

        $category->parent_id = $request->parent_id;//form
        $category->sort_order = $request->sort_order; //form
        $category->metakey = $request->metakey; //form
        $category->description = $request->description; //form
        $category->created_at = date('Y-m-d H:i:s');
        $category->created_by = 1;
        $category->status = $request->status; //form
        $category->save(); //Luuu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'categorys' => $category],201); 
    }

    /*update*/
    public function update(Request $request,$id){
        $category = Category::find($id);
        $category->name = $request->name; // form
        $category->slug = Str::of($request->name)->slug('-');
        // $category->image = $request->name;
        $category->parent_id = $request->parent_id;
        $category->sort_order = $request->sort_order; //form
        $category->metakey = $request->metakey; //form
        $category->description = $request->description; //form
        $category->updated_at = date('Y-m-d H:i:s');
        $category->updated_by = 1;
        $category->status = $request->status; //form
        $category->save(); //Luuu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thành công', 'categorys' => $category],200);
    }
    

    /* xoa */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return response()->json(
                ['message' => 'Tai du lieu khong thanh cong', 'success' => false, 'categorys' => null],
                404
            );
        }
        $category->delete();
        return response()->json(['message' => 'Thanh cong', 'success' => true, 'categorys' => $category], 200);

    }
    /* lay du lieu len frontend */
    // public function category_list($parent_id=0,$status=1){
    //     $args = [
    //         ['parent_id','=',$parent_id],
    //         ['status','=',$status]
    //     ];
    //     $data = Category::where($args)->orderBy('sort_order','ASC')->get();
    //     return response()->json($data,200);
    // }
    public function category_list($parent_id = 0)
    {
        $args = [
            ['parent_id', '=', $parent_id],
            ['status', '=', 1]
        ];
        $categorys = Category::where($args)
            ->orderBy('sort_order', 'ASC')
            ->get();
        return response()->json(
            [
                'success' => true,
                'message' => 'Tải dữ liệu thành công',
                'categorys' => $categorys
            ],
            200
        );
    }
}