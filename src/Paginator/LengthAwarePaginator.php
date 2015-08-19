<?php namespace AgelxNash\SEOPagination\Paginator;

use Config;

class LengthAwarePaginator extends \Illuminate\Pagination\LengthAwarePaginator{
	use ReplaceUrl;

	public function __construct($items, $total, $perPage, $currentPage = null, array $options = [])
	{
		$options = array_merge(
			[
				'actionOnError' => Config::get('seo-pagination.action_on_error', $this->getActionOnError()),
				'errorStatus' => Config::get('seo-pagination.error_status', $this->getErrorStatus()),
				'keepQuery' => Config::get('seo-pagination.keep_query', $this->getKeepQuery())
			], $options
		);
		parent::__construct($items, $total, $perPage, $currentPage, $options);
	}
}