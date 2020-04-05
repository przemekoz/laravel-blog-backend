<?php

namespace App\Http;

class Responses
{

    public static function list($result, $sortMode, $filterMode, $mapFoo)
    {
		$data = array();
		foreach ($result->items() as $item) {
			array_push($data, $mapFoo($item));
		}
		$meta = [
			'total' => $result->total(), 
			'currentPage' => $result->currentPage(), 
			'lastPage' => $result->lastPage(), 
			'size' => $result->perPage(),
			'sort' => $sortMode,
			'filter' => $filterMode
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
		return ['page' => $page, 'size' => $size];
	}
	
	public static function getSorting($sort)
	{
		if ( $sort === '' ) {
			return ['column' => 'created_at', 'direction' => 'ASC', 'mode' => 'created-at'];
		}
		
		$isDescStr = substr($sort , 0, 1);
		$direction = $isDescStr === '-' ? 'DESC' : 'ASC';
		$column = $direction === 'DESC' ? substr( $sort , 1 ) : $sort;
		return ['column' => $column, 'direction' => $direction, 'mode' => $sort];
	}
	
	public static function getFiltering($filter, $filterType, $availableFields)
	{
		$availableFields = array_merge($availableFields, ['created_at', 'updated_at']);
		$filtersMode = [];
		$filters = [];
		forEach(array_keys($filter) as $key) {
			if (in_array($key, $availableFields)) {
				$operator = Responses::getOperator($key, $filterType);
				$parameter = $operator === 'like' ? "%{$filter[$key]}%" : $filter[$key];
				
				array_push($filtersMode, $key);
				forEach(Responses::getFilterItem($key, $operator, $parameter) as $item) {
					array_push($filters, $item);
				}
			}
		}
		
		return [$filters, join(',', $filtersMode)];
	}
	
	private static function getOperator($key, $filterType)
	{
		$type = array_key_exists($key, $filterType) ? strtolower($filterType[$key]) : 'default';
		switch ($type) {
			case 'text':
				return 'like';
			case 'range':
				return 'range';
			default:
				return '=';
		}
	}
		
	private static function getFilterItem($key, $operator, $parameter)
	{
		$items = [];
		
		switch ($operator) {
			case 'range':
				$fromTo = explode(',', $parameter);
				
				if ( count($fromTo) === 2 ) {
					list( $from, $to ) = $fromTo;
					if ( strtolower($from) !== 'null' ) {
						array_push($items, ['column' => $key, 'operator' => '>=', 'parameter' => $from]);
					}
					if ( strtolower($to) !== 'null' ) {
						array_push($items, ['column' => $key, 'operator' => '<=', 'parameter' => $to]);	
					}
				}
				
				break;
			default:
				array_push($items, ['column' => $key, 'operator' => $operator, 'parameter' => $parameter]);
				break;
		}
		
		return $items;
	}		
	

}