<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateSupplierRequest;

class SupplierController extends Controller
{
  public function index()
  {
      $suppliers = Supplier::all();
      $data = SupplierResource::collection($suppliers);
      return response()->json($data);
  }

  public function store(CreateSupplierRequest $request)
  {      
      $validated = $request->validated();
      
      $input = $request->all();

      $supplier = Supplier::create($input);

      if($supplier->save())
      {
        return response()->json(['message' => 'Supplier successfuly saved!', $supplier, 200]);
      }

      return response()->json(['message' => 'Failed to save Supplier', $supplier]);
  }

  public function show($id)
  {
      $supplier = Supplier::findOrFail($id);
      $data = new SupplierResource($supplier);
      return response()->json($data);
  }

  public function update(CreateSupplierRequest $request, $id)
  {
      $validated = $request->validated();
      
      $updatedSupplierInfo = [
          'supplier_name' => $request->supplier_name,
          'supplier_contact_number' => $request->supplier_contact_number,
          'supplier_address' => $request->supplier_address,
      ];

      $updatedSupplier = Supplier::where('id', $id)
          ->update($updatedSupplierInfo);
      
      $supplier = Supplier::where('id', $id)->update($request->all(), $id);
      return response()->json(['message' => 'Supplier successfuly updated!', $supplier, 200]);
  
  }

  public function destroy($id)
  {
      $supplier = Supplier::findOrFail($id);
      
      if($supplier->delete())
      {
          return response()->json(['message' => 'Supplier successfuly deleted!', $data]);
      }

      return response()->json(['message' => 'Failed to remove Supplier.', $data]);

  }
}
