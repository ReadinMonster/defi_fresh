<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;

class ProductController extends Controller
{
  public function index()
  {
      $products = Product::all();
      $data = ProductResource::collection($products);
      return response()->json($data);
  }

  public function store(CreateProductRequest $request)
  {      
      $validated = $request->validated();
      
      $input = $request->all();

      $product = Product::create($input);

      if($product->save())
      {
        return response()->json(['message' => 'Product successfuly saved!', $product, 200]);
      }

      return response()->json(['message' => 'Failed to save Product', $product]);
  }

  public function show($id)
  {
      $product = Product::findOrFail($id);
      $data = new ProductResource($product);
      return response()->json($data);
  }

  public function update(CreateProductRequest $request, $id)
  {
      $validated = $request->validated();
      
      $updatedProductInfo = [
          'category_id' => $request->category_id,
          'supplier_id' => $request->supplier_id,
          'brand_id' => $request->brand_id,
          'product_name' => $request->product_name,
          'product_quantity' => $request->product_quantity,
          'product_price' => $request->product_price,
      ];

      $updatedProduct = Product::where('id', $id)
          ->update($updatedProductInfo);
      
      $product = Product::where('id', $id)->update($request->all(), $id);
      return response()->json(['message' => 'Product successfuly updated!', $product, 200]);
  
  }

  public function destroy($id)
  {
      $product = Product::findOrFail($id);
      
      if($product->delete())
      {
          return response()->json(['message' => 'Product successfuly deleted!', $data]);
      }

      return response()->json(['message' => 'Failed to remove Product.', $data]);

  }
}
