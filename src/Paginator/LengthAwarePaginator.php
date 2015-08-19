<?php namespace AgelxNash\SEOPagination\Paginator;

class LengthAwarePaginator extends \Illuminate\Pagination\LengthAwarePaginator{
	use ReplaceUrl;

	public function __construct($items, $total, $perPage, $currentPage = null, array $options = [])
	{
		parent::__construct($items, $total, $perPage, $currentPage, $this->mergeOptions($options));
	}
	
	
}