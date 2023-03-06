<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\File;

class ProductDetailController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
    public function index(Request $request,$id ='')
    {
        // dd(ProductDetail::select('size_id','color_id','product_id','name','quantity')->get()->toArray());
        if(empty($id))
        {
            return redirect()->route('admin.product.index')->with('error', 'Product not found');
        }

        $product = Product::where('id',$id)->whereNull('deleted_at')->first();

        if(empty($product))
        {
            return redirect()->route('admin.product.index')->with('error', 'Product not found');
        }
        $size = Size::whereNull('deleted_at')->get();
        $color = Color::whereNull('deleted_at')->get();
        $query = ProductDetail::where('product_id',$id);
        $search_size = $request->search_size;
        $search_color = $request->search_color;
        // dd($search_size,$search_color);
        if(!empty($search_size))
        {
            $query->whereHas('size',function($query) use ($search_size){
                $query->where('id',$search_size);
            });
        }
        if(!empty($search_color))
        {
            $query->whereHas('color',function($query) use ($search_color){
                $query->where('id',$search_color);
            });
        }
        $product_detail = $query->with(['size','color'])->paginate(10);
        // dd($product_detail);
        if(empty($product_detail))
        {
            return redirect()->back()->with('error', 'Product detail not found');
        }
        $data = [
            'colors' => $color,
            'sizes' => $size,
            'product' => $product,
            'rows' => $product_detail,
            'breadcrumbs'        => [
                [
                    'name' => 'Product',
                    'url'  => 'admin/product',
                ],
                [
                    'name' => $id,
                    // 'url'  => 'admin/dashboard',
                ],
                [
                    'name' => 'Detail',
                    // 'url'  => 'admin/dashboard',
                ],
            ],
            'isProduct'=>true,
        ];
        return view('admin.product-detail.index',$data);
    }
    public function store(Request $request,$id)
    {
        // dd($request->all());
        if(empty($id))
        {
            return redirect()->back()->with('error', 'Product not found');
        }
        if(empty($request->id_product_detail))
        {
            $product_detail = ProductDetail::whereNull('deleted_at')
                                    ->where('id','<>',$request->id_product_detail)
                                    ->where('product_id',$id)
                                    ->where('size_id',$request->size)
                                    ->where('color_id',$request->color)
                                    ->first();
            if(!empty($product_detail))
            {
                return redirect()->back()->with('error', 'Product details already exist');
            }

            $product_detail = ProductDetail::where('product_id',$request->id_product_detail)
            ->where('size_id',$request->size)
            ->where('color_id',$request->color)
            ->whereNull('deleted_at')
            ->first();
            if(!empty($product_detail))
            {
                return redirect()->back()->with('error', 'Product details already exist');
            }
            $product_detail = new ProductDetail();
            $product_detail->size_id = $request->size;
            $product_detail->color_id = $request->color;
            $product_detail->product_id = $request->id;
            $product_detail->quantity = $request->quantity;

            $size = Size::whereNull('deleted_at')->where('id',$request->size)->first();
            $color = Color::whereNull('deleted_at')->where('id',$request->color)->first();
            $product = Product::whereNull('deleted_at')->where('id',$request->id)->first();

            $product_detail_name = $product->name." - ".$size->name." - ".$color->name;
            $product_detail->name = $product_detail_name;
            
            $product_detail->save();

            return redirect()->back()->with('success','Create product details successfully');
        }
        
        $product_detail = ProductDetail::whereNull('deleted_at')
                        ->where('id','<>',$request->id_product_detail)
                        ->where('product_id',$id)
                        ->where('size_id',$request->size)
                        ->where('color_id',$request->color)
                        ->first();
        if(!empty($product_detail))
        {
            return redirect()->back()->with('error', 'Product details already exist');
        }

        $product_detail = ProductDetail::whereNull('deleted_at')
                ->where('id',$request->id_product_detail)
                ->first();
        if(empty($product_detail))
        {
            return redirect()->back()->with('error', 'Product details not found');
        }
        // dd($product_detail);
        $product_detail->size_id = $request->size;
        $product_detail->color_id = $request->color;
        $product_detail->product_id = $request->id;
        $product_detail->quantity = $request->quantity;

        $size = Size::whereNull('deleted_at')->where('id',$request->size)->first();
        $color = Color::whereNull('deleted_at')->where('id',$request->color)->first();
        $product = Product::whereNull('deleted_at')->where('id',$request->id)->first();

        $product_detail_name = $product->name." - ".$size->name." - ".$color->name;
        $product_detail->name = $product_detail_name;

        $product_detail->save();

        return redirect()->back()->with('success', 'Update product details successfully');
    }

    public function delete(Request $request,$id = '')
    {
        // dd(json_decode($request->list_id));
        $list_id = json_decode($request->list_id);
        foreach($list_id as $product_detail_id)
        {
            $product_detail = ProductDetail::find($product_detail_id);
            if(!empty($product_detail))
            {
                
                
                $product_detail->delete();
            }
        }
        return redirect()->back()->with('success', 'Delete product details successfully');
    }
}