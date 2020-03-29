<?php

namespace App\Http;

class Responses
{
    protected $fillable = ['title'];

    public static function list($data)
    {
        return ["data" => $data, "meta" => ["acme" => "acme"]];
    }
	
	
	
	public static function item($id, $type, $attributes)
	{
		return ["id" => $id, "type" => $type, "attributes" => $attributes];
	}

	public static function itemWithRelations($id, $type, $attributes, $relType, $relationData)
	{
		$relData = array();
		foreach ($relationData as $item) {
			array_push($relData, ["id" => $item->id, "type" => $relType]);
		}
		return array_merge(Responses::item($id, $type, $attributes), ["relationships" => [$relType => ["data" => $relData] ], "includes" => $relationData]);
	}

}