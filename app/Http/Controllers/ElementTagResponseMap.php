<?php

namespace App\Http\Controllers;

use App\ElementTag;
use App\Http\Responses;

class ElementTagResponseMap {
	public static function getAttributes(ElementTag $elementTag) {
		return ["title" => $elementTag->title, "created-at" => $elementTag->created_at->toAtomString(), "updated-at" => $elementTag->updated_at->toAtomString()];
	}
	
	public static function map(ElementTag $elementTag) {
		return Responses::item($elementTag->id, "tags", ElementTagResponseMap::getAttributes($elementTag));
	}
}
