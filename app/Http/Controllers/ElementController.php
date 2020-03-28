<?php

namespace App\Http\Controllers;

use App\Element;
use Illuminate\Http\Request;



class ElementController extends Controller
{
	
	private function mapElement(Element $element) {
		return ["id" => $element->id, "type" => "elements", "attributes" => ["title" => $element->title, "description" => $element->description]];
	}
	
	private function mapElementWithTags(Element $element) {
		
		$relData = array();
		foreach ($element->tags()->get() as $tag) {
			array_push($relData, ["id" => $tag->id, "type" => "tags"]);
		}
		
		return ["id" => $element->id, "type" => "elements", "attributes" => ["title" => $element->title, "description" => $element->description], "relationships" => ["tags" => ["data" => $relData] ]];
	}
	
    public function index()
    {
		$arr = array();
		foreach (Element::all() as $elem) {
			array_push($arr, $this->mapElement($elem));
		}
        //return Element::all();
		return $arr;
    }
 
    public function show(Element $element)
    {
		return response()->json($this->mapElement($element), 200);
    }

    public function showWithTags(Element $element)
    {
        return response()->json($this->mapElementWithTags($element), 200);
    }

    public function store(Request $request)
    {
        $element = Element::create($request->all());
        return response()->json($element, 201);
    }

    public function update(Request $request, Element $element)
    {
        $element->update($request->all());
        return response()->json($element, 200);
    }

    public function delete(Element $element)
    {
        $element->delete();
        return response()->json(null, 204);
    }
}
