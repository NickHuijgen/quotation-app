<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        //Return all products, newest first
        return Product::orderby('id', 'desc')->paginate(10);
    }

    public function show(Request $request, $id)
    {
        return [
            //Find (or fail) a product by its id and return its data
            'data' => Product::findOrFail($id)
        ];
    }

    public function update(Request $request, $id)
    {
        //Request all new  data and save it to the $product variable
        $product = $request->all();

        //Find a product by its id and update its data with the new $hour data
        Product::find($id)->update($product);

        //Return the updated product data
        return $product;
    }

    public function store()
    {
        //Create a new product with the requested data
        return Product::create(request()->all());
    }

    public function destroy(Product $product)
    {
        //Delete a product
        $product->delete();

        return 'Product deleted';
    }
}
