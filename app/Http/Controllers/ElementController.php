<?php

namespace App\Http\Controllers;

use App\Element;
use App\Http\Responses;
use App\Http\Controllers\ElementResponseMap;
use App\Http\Controllers\ElementTagResponseMap;
use Illuminate\Http\Request;


class ElementController extends Controller
{
	public function mapWithTags(Element $element) {
		//ElementTagResponseMap::map
		return Responses::itemWithRelations(
			$element->id, 
			"elements", 
			ElementResponseMap::getAttributes($element), 
			"tags", 
			$element->tags()->get(), 
			function ($tag){ 
				return ElementTagResponseMap::map($tag);
			}
		);
	}
	
    public function index()
    {
		$arr = array();
		foreach (Element::all() as $elem) {
			array_push($arr, ElementResponseMap::map($elem));
		}
        //return Element::all();
		return Responses::list($arr);
    }
 
    public function show(Element $element)
    {
		return response()->json(ElementResponseMap::map($element), 200);
    }

    public function showWithTags(Element $element)
    {
        return response()->json($this->mapWithTags($element), 200);
    }

    public function store(Request $request)
    {
        $element = Element::create($request->all());
        return response()->json(ElementResponseMap::map($element), 201);
    }

    public function update(Request $request, Element $element)
    {
        $element->update($request->all());
        return response()->json(ElementResponseMap::map($element), 200);
    }

    public function delete(Element $element)
    {
        $element->delete();
        return response()->json(null, 204);
    }
}
