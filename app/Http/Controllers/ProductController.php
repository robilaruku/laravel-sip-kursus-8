<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::pluck('name', 'id');

        $category = request('category');
        $search   = request('search');

        $products = new Product;

        $paginate = 3;

        // Filter by category
        if (!empty($category)) {
            $products = $products->where('category_id', $category);
        }

        // Filter by name
        if (!empty($search)) {
            $products = $products->orWhere('name', 'LIKE', "%{$search}%");
        }

        $products = $products->paginate($paginate);

        return view('admin.products.index', compact(
            'categories',
            'category',
            'search',
            'products'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->toArray();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'sku' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'required',
        ];

        $messages = [
            'category_id.required' => 'Category Field Required',
            'name.required' => 'Name Field Required',
            'price.required' => 'Price Field Required',
            'sku.required' => 'Sku Field Required',
            'description.required' => 'Description Field Required',
            'status.required' => 'Status Field Required',
            'image.required' => 'Image Field Required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->image = $request->file('image')->store('Products', 'public');
        $product->save();

        Session::flash('message', 'Product saved successfully');

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::pluck('name', 'id')->toArray();

        return view('admin.products.show', compact('product', 'categories'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::pluck('name', 'id')->toArray();

        return view('admin.products.edit', compact('product', 'categories'));
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
        $rules = [
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'sku' => 'required',
            'description' => 'required',
            'status' => 'required',
        ];

        $messages = [
            'category_id.required' => 'Category Field Required',
            'name.required' => 'Name Field Required',
            'price.required' => 'Price Field Required',
            'sku.required' => 'Sku Field Required',
            'description.required' => 'Description Field Required',
            'status.required' => 'Status Field Required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $product = Product::find($id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->status = $request->status;

        if ($request->file('image')) {
            $product->image = $request->file('image')->store('Products', 'public');
        }

        $product->save();

        Session::flash('message', 'Product updated successfully');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        Session::flash('message', 'Product deleted successfully');

        return redirect()->route('products.index');

    }
}
