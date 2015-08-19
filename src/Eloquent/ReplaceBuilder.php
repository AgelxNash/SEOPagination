<?php namespace AgelxNash\SEOPagination\Eloquent;

trait ReplaceBuilder{
	/**
	 * Create a new Eloquent query builder for the model.
	 *
	 * @param  \Illuminate\Database\Query\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder|static
	 */
	public function newEloquentBuilder($query)
	{
		return new \AgelxNash\SEOPagination\Eloquent\Builder($query);
	}

	/**
	 * Get a new query builder instance for the connection.
	 *
	 * @return \Illuminate\Database\Query\Builder
	 */
	protected function newBaseQueryBuilder()
	{
		$conn = $this->getConnection();

		$grammar = $conn->getQueryGrammar();

		return new \AgelxNash\SEOPagination\Query\Builder($conn, $grammar, $conn->getPostProcessor());
	}
}