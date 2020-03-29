<?php

namespace App\Http\Controllers;

use App\ElementTag;
use App\Http\Responses;

class ElementTagResponseMap {
	public static function getAttributes(ElementTag $elementTag) {
		return ["title" => $elementTag->title, "created_at" => $elementTag->created_at, "updated_at" => $elementTag->updated_at];
	}
	
	public static function map(ElementTag $elementTag) {
		return Responses::item($elementTag->id, "tags", ElementTagResponseMap::getAttributes($elementTag));
	}
}
