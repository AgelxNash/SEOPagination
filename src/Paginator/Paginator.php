<?php namespace AgelxNash\SEOPagination\Paginator;

class Paginator extends \Illuminate\Pagination\Paginator{
	use ReplaceUrl;

	public function __construct($items, $perPage, $currentPage = null, array $options = [])
	{
		parent::__construct($items, $perPage, $currentPage, $this->mergeOptions($options));
	}
}