<?php

namespace App\Http;

class Responses
{

    public static function list($result, $mapFoo)
    {
		//print_r($result);
		$data = array();
		foreach ($result->items() as $item) {
			array_push($data, $mapFoo($item));
		}
		$meta = [
			'total' => $result->total(), 
			'currentPage' => $result->currentPage(), 
			'lastPage' => $result->lastPage(), 
			'size' => $result->perPage()
		];
		return ['data' => $data, 'meta' => $meta];
		
    }
	
	public static function item($id, $type, $attributes)
	{
		return ["id" => $id, "type" => $type, "attributes" => $attributes];
	}

	public static function itemWithRelations($id, $type, $attributes, $relType, $relationData, $mapFoo)
	{
		$relData = array();
		$includes = array();
		foreach ($relationData as $item) {
			array_push($relData, ["id" => $item->id, "type" => $relType]);
			array_push($includes, $mapFoo($item));
		}
		
		return array_merge(Responses::item($id, $type, $attributes), ["relationships" => [$relType => ["data" => $relData] ], "includes" => $includes]);
	}
	
	public static function getPaging($page)
	{
		$size = isset($page['size']) ? $page['size'] : 10;
		$page = isset($page['number']) ? $page['number'] : 0;	
		return ['page'=>$page, 'size'=>$size];
	}

}