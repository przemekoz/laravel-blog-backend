<?php

namespace App\Http\Controllers;

use App\Element;
use Illuminate\Http\Request;

class ElementController extends Controller
{
    public function index()
    {
        return Element::all();
    }
 
    public function show(Element $element)
    {
        return $element;
    }

    public function showWithTags(Element $element)
    {
        return response()->json(["title" => $element->title, "description" => $element->description, "tags" => $element->tags()->get() ], 200);
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
