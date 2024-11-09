<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {    $search = $request->input('search');
        $sort = $request->input('sort');

        $products = Product::when($search, function($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('product_id', 'like', '%' . $search . '%');
            })
            ->when($sort, function($query, $sort) {
                if (in_array($sort, ['name', 'price'])) {
                    $query->orderBy($sort);
                }
            }, function($query) {
                $query->orderBy('created_at', 'DESC');
            })
            ->paginate(5);

        return view('products.index', [
            'products' => $products,
            'search' => $search,
            'sort' => $sort
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rools = [
            'name' => 'required|string|max:255|min:5',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ];

        $validator = Validator::make($request->all(),$rools);

        $product_id = 'P' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        if($validator->fails()){
            return  redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $imageName);
            $imagePath = 'uploads/products/' . $imageName;
        }


        Product::create([
            'product_id' => $product_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);






         return redirect()->route('products.index')->withInput()->with('success','Product added succeccfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

       return view('products.edit',[
        'product'=>$product
       ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

   
    $rules = [
        'name' => 'required|string|max:255|min:5',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'nullable|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];


    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return redirect()->route('products.edit', $product->id)
                         ->withInput()
                         ->withErrors($validator);
    }

    
    $imagePath = $product->image;  
    if ($request->hasFile('image')) {

        File::delete(public_path('uploads/products/' . $product->image));


        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/products'), $imageName);
        $imagePath = 'uploads/products/' . $imageName;
    }


    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'image' => $imagePath,
    ]);


    return redirect()->route('products.index')
                     ->withInput()
                     ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);


        if ($product->image) {
            File::delete(public_path($product->image));
        }


        $product->delete();

        
        return redirect()->route('products.index')
                         ->with('delete', 'Product deleted successfully!');
    }


    public function searchSuggestions(Request $request)
{
    $search = $request->get('query');
    $suggestions = Product::where('name', 'LIKE', "%{$search}%")
                          ->take(5)
                          ->pluck('name');

    return response()->json($suggestions);
}
public function getSuggestions(Request $request)
{
    $query = $request->get('query');
    $products = Product::where('name', 'like', "%{$query}%")->get();
    return response()->json($products);
}



}