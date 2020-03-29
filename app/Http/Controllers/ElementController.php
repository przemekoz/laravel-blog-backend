<?php

namespace App\Http\Controllers;

use App\Element;
use App\Http\Responses;
use Illuminate\Http\Request;

class ElementController extends Controller
{
	
	private function getAttributes(Element $element) {
		return ["title" => $element->title, "description" => $element->description];
	}
	
	private function map(Element $element) {
		return Responses::item($element->id, "elements", $this->getAttributes($element));
	}
	
	private function mapWithTags(Element $element) {
		return Responses::itemWithRelations($element->id, "elements", $this->getAttributes($element), "tags", $element->tags()->get());
	}
	
    public function index()
    {
		$arr = array();
		foreach (Element::all() as $elem) {
			array_push($arr, $this->map($elem));
		}
        //return Element::all();
		return Responses::list($arr);
    }
 
    public function show(Element $element)
    {
		return response()->json($this->map($element), 200);
    }

    public function showWithTags(Element $element)
    {
        return response()->json($this->mapWithTags($element), 200);
    }

    public function store(Request $request)
    {
        $element = Element::create($request->all());
        return response()->json($this->map($element), 201);
    }

    public function update(Request $request, Element $element)
    {
        $element->update($request->all());
        return response()->json($this->map($element), 200);
    }

    public function delete(Element $element)
    {
        $element->delete();
        return response()->json(null, 204);
    }
}
