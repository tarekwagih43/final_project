<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.*', 'categories.title as category_title')
                    ->where('products.deleted_at', Null)
                    ->paginate(5);

        $data = [
            'products' => $products,
            'page_title' => 'products',
            'back_link' => route('/'),
            'links' => ['Dashboard', 'products' ]
        ];

        return view('product.index', [
            'data' => $data
        ]);
    }

    public function add_form()
    {
        $categories = Category::withoutTrashed()->get();

        $data = [
            'categories' => $categories,
            'page_title' => 'products Add',
            'back_link' => route('/'),
            'links' => ['Dashboard', 'Product Add' ]
        ];
        return view('product.add', ['data' => $data]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'price' => 'required|max:11',
            'description' => 'required|max:500',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $imageName = time().'.'.$request->image->extension();

        Product::create([
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'image' => "upload/".$imageName,
            'category_id' => $request->category_id
        ]);

        $request->image->move(public_path('upload'), $imageName);


        return redirect()->route('products')
            ->with('success','You have successfully add Product.');
    }

    public function edit_form(Product $product)
    {
        $product = Product::where('id', $product->id)->first();
        $categories = Category::withoutTrashed()->get();

        $data = [
            'categories' => $categories,
            'product' => $product,
            'page_title' => 'products Edit',
            'back_link' => route('/'),
            'links' => ['Dashboard', 'Product Edit' ]
        ];
        return view('product.edit', ['data' => $data]);
    }

    public function edit(Request $request)
    {
        // valdiation
        $this->validate($request, [
            'title' => 'required|max:255'
        ]);

        if(!empty($request->image)){
            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('upload'), $imageName);

            DB::table('products')->where('id', $request->id)->update([
                'title' => $request->title,
                'price' => $request->price,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'image' => "upload/".$imageName
            ]);
        }else {
            DB::table('products')->where('id', $request->id)->update([
                'title' => $request->title,
                'price' => $request->price,
                'description' => $request->description,
                'category_id' => $request->category_id,
            ]);
        }

        // redirect back
        return redirect()->route('products')
                ->with('success', 'Updated Succesfully');
    }

    public function destroy(Product $product)
    {
        $product = Product::where('id', $product->id)->first();
        if($product->count())
        {
            $product->delete();
        }
        else 
        {
            return back()
                ->with('Error', 'Error : Product Dosn`t Exist!');
        }

        return back()
                ->with('success', 'Deleted Succesfully');
    }

    public function get_price(Request $request){
        $product = Product::where('id', $request->id)->first();
        if($product) {
            $price = $product->price;
        }
        else {
            $price = 0;
        }
        return response()->json([
            'price' => $price
        ]);
    }

    public function get_products_with_category(Request $request){
        $products = Product::withoutTrashed()->where('category_id', $request->category_id)->get();

        return response()->json($products);
    }

}
