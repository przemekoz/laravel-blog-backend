<?php

namespace App\Http\Controllers;

use App\ElementTag;
use Illuminate\Http\Request;

class ElementTagController extends Controller
{
    public function index()
    {
        return ElementTag::all();
    }
 
    public function show(ElementTag $elementTag)
    {
        return $elementTag;
    }

    public function store(Request $request)
    {
        $elementTag = ElementTag::create($request->all());
        return response()->json($elementTag, 201);
    }

    public function update(Request $request, ElementTag $elementTag)
    {
        $elementTag->update($request->all());
        return response()->json($elementTag, 200);
    }

    public function delete(ElementTag $elementTag)
    {
        $elementTag->delete();
        return response()->json(null, 204);
    }
}
