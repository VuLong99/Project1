<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\ProductDetail;

class SizeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
    public function index(Request $request)
    {
        $query = Size::whereNull('deleted_at');
        if(!empty($request->search))
        {
            $query->where('name','like','%'.$request->search.'%');
        }
        $size = $query->paginate(10);
        $data = [
            'rows' => $size,
            'breadcrumbs'        => [
                [
                    'name' => 'Size',
                    // 'url'  => 'admin/dashboard',
                ],
            ],
            'isProduct'=>true,
        ];
        return view('admin.size.index',$data);
    }
    public function store(Request $request)
    {
        if(empty($request->id_size))
        {
            $size =Size::where('name',$request->name_size)->whereNull('deleted_at')->first();

            if(!empty($size))
            {

                return redirect()->back()->with('error', 'Dimensions already exist');
            }

            $size = new size();
            $size->name = $request->name_size;
            $size->save();
            return redirect()->back()->with('success', 'Size created successful');
        }

        $size =Size::where('name',$request->name_size)->where('id','<>',$request->id_size)->whereNull('deleted_at')->first();
        if(!empty($size))
        {
            return redirect()->back()->with('error', 'Size already exist');
        }
        
        $size = Size::find($request->id_size);
        if(empty($size))
        {
            return redirect()->back()->with('error', 'Size not found');
        }
       
        $size->name = $request->name_size;
        $size->save();
        return redirect()->back()->with('success', 'Size update successful');
    }
    public function delete(Request $request)
    {
        $list_id = json_decode($request->list_id);
        foreach($list_id as $id)
        {
            $size = Size::find($id);
            if(!empty($size))
            {
                $product_detail = ProductDetail::whereNull('deleted_at')->where('size_id',$size->id)->get();
                
                if(count($product_detail) > 0)
                {
                    return redirect()->back()->with('error', 'There are products with sizes '.$size->name);
                }

                $size->delete();
            }
        }
        return redirect()->back()->with('success', 'Remove size successfully');
    }
}