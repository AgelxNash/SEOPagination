<?php namespace AgelxNash\SEOPagination\Query;

trait ReplaceBuilder{
	/**
	 * Begin a fluent query against a database table.
	 *
	 * @param  string  $table
	 * @return \AgelxNash\SEOPagination\Query\Builder
	 */
	public function table($table)
	{
		$processor = $this->getPostProcessor();

		$query = new Builder($this, $this->getQueryGrammar(), $processor);

		return $query->from($table);
	}
}