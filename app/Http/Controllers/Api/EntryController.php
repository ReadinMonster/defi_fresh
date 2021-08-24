<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\EntryResource;
use App\Models\Entry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntryController extends Controller
{
  public function index()
  {
      $entries = Entry::all();
      $data = EntryResource::collection($entries);
      return response()->json($data);
  }

}
