<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateBrandRequest;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $data = BrandResource::collection($brands);
        return response()->json($data);
    }

    public function store(CreateBrandRequest $request)
    {      
        $validated = $request->validated();
        
        $input = $request->all();

        $brand = Brand::create($input);

        if($brand->save())
        {
          return response()->json(['message' => 'Brand successfuly saved!', $brand, 200]);
        }

        return response()->json(['message' => 'Failed to save brand', $brand]);
    }

    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        $data = new BrandResource($brand);
        return response()->json($data);
    }

    public function update(CreateBrandRequest $request, $id)
    {
        $validated = $request->validated();
        
        $updatedBrandInfo = [
            'brand_description' => $request->brand_description,
        ];

        $updatedBrand = Brand::where('id', $id)
            ->update($updatedBrandInfo);
        
        $brand = Brand::where('id', $id)->update($request->all(), $id);
        return response()->json(['message' => 'Brand successfuly updated!', $brand, 200]);
    
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        
        if($brand->delete())
        {
            return response()->json(['message' => 'Brand successfuly deleted!', $data]);
        }

        return response()->json(['message' => 'Failed to remove brand.', $data]);

    }
}
