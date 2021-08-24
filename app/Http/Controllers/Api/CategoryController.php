<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;

class CategoryController extends Controller
{
  public function index()
  {
      $categories = Category::all();
      $data = CategoryResource::collection($categories);
      return response()->json($data);
  }

  public function store(CreateCategoryRequest $request)
  {      
      $validated = $request->validated();
      
      $input = $request->all();

      $category = Category::create($input);

      if($category->save())
      {
        return response()->json(['message' => 'Category successfuly saved!', $category, 200]);
      }

      return response()->json(['message' => 'Failed to save category', $category]);
  }


}
