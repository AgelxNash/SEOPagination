<?php namespace AgelxNash\SEOPagination\Paginator;

use Config;

class Paginator extends \Illuminate\Pagination\Paginator{
	use ReplaceUrl;

	public function __construct($items, $perPage, $currentPage = null, array $options = [])
	{
		$options = array_merge(
			[
				'actionOnError' => Config::get('action_on_error', $this->getActionOnError()),
				'errorStatus' => Config::get('error_status', $this->getErrorStatus()),
				'keepQuery' => Config::get('keep_query', $this->getKeepQuery())
			], $options
		);

		parent::__construct($items, $perPage, $currentPage, $options);
	}
}