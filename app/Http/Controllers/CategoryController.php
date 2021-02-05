<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $categories = Category::withoutTrashed()->paginate(5);
        $data = [
            'categories' => $categories,
            'page_title' => 'Categories',
            'back_link' => route('/'),
            'links' => ['Dashboard', 'Categories' ]
        ];

        return view('category.index', [
            'data' => $data
        ]);
    }

    public function add_form()
    {
        $data = [
            'page_title' => 'Categories Add',
            'back_link' => route('/'),
            'links' => ['Dashboard', 'Category Add' ]
        ];
        return view('category.add', ['data' => $data]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255'
        ]);

        Category::create([
            'title' => $request->title
        ]);

        return redirect()->route('categories')
            ->with('success','You have successfully add Category.');
    }

    public function edit_form(Category $category)
    {
        $category = Category::where('id', $category->id)->first();

        $data = [
            'category' => $category,
            'page_title' => 'Categories Edit',
            'back_link' => route('/'),
            'links' => ['Dashboard', 'Category Edit' ]
        ];
        return view('category.edit', ['data' => $data]);
    }

    public function edit(Request $request)
    {
        // valdiation
        $this->validate($request, [
            'title' => 'required|max:255'
        ]);

        DB::table('categories')->where('id', $request->id)->update(['title' => $request->title]);


        // redirect back
        return redirect()->route('categories')
                ->with('success', 'Updated Succesfully');
    }

    public function destroy(Category $category)
    {
        $category = Category::where('id', $category->id)->first();
        if($category->count())
        {
            $category->delete();
        }
        else 
        {
            return back()
                ->with('Error', 'Error : Category Dosn`t Exist!');
        }

        return back()
                ->with('success', 'Deleted Succesfully');
    }

}
