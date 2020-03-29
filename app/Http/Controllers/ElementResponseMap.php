<?php

namespace App\Http\Controllers;

use App\Element;
use App\Http\Responses;

class ElementResponseMap {
	public static function getAttributes(Element $element) {
		return ["title" => $element->title, "description" => $element->description, "created_at" => $element->created_at, "updated_at" => $element->updated_at];
	}
	
	public static function map(Element $element) {
		return Responses::item($element->id, "elements", ElementResponseMap::getAttributes($element));
	}
}
