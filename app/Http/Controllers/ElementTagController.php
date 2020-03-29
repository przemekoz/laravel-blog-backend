<?php

namespace App\Http\Controllers;

use App\ElementTag;
use App\Http\Responses;
use App\Http\Controllers\ElementTagResponseMap;
use Illuminate\Http\Request;

class ElementTagController extends Controller
{	
    public function index()
    {
		$arr = array();
		foreach (ElementTag::all() as $elem) {
			array_push($arr, ElementTagResponseMap::map($elem));
		}
        //return ElementTag::all();
		return Responses::list($arr);
    }
 
    public function show(ElementTag $elementTag)
    {
        return response()->json(ElementTagResponseMap::map($elementTag), 200);
    }

    public function store(Request $request)
    {
        $elementTag = ElementTag::create($request->all());
		return response()->json(ElementTagResponseMap::map($elementTag), 201);
    }

    public function update(Request $request, ElementTag $elementTag)
    {
        $elementTag->update($request->all());
        return response()->json(ElementTagResponseMap::map($elementTag), 200);
    }

    public function delete(ElementTag $elementTag)
    {
        $elementTag->delete();
        return response()->json(null, 204);
    }
}
