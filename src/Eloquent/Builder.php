<?php namespace AgelxNash\SEOPagination\Eloquent;

use AgelxNash\SEOPagination\Paginator\Paginator;
use AgelxNash\SEOPagination\Paginator\LengthAwarePaginator;

class Builder extends \Illuminate\Database\Eloquent\Builder{
	/**
	 * Paginate the given query.
	 *
	 * @param  int  $perPage
	 * @param  array  $columns
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function paginate($perPage = null, $columns = ['*'])
	{
		$total = $this->query->getCountForPagination();

		$this->query->forPage(
			$page = Paginator::resolveCurrentPage(),
			$perPage = $perPage ?: $this->model->getPerPage()
		);

		return new LengthAwarePaginator($this->get($columns), $total, $perPage, $page, [
			'path' => Paginator::resolveCurrentPath(),
		]);
	}

	/**
	 * Paginate the given query into a simple paginator.
	 *
	 * @param  int  $perPage
	 * @param  array  $columns
	 * @return \Illuminate\Contracts\Pagination\Paginator
	 */
	public function simplePaginate($perPage = null, $columns = ['*'])
	{
		$page = Paginator::resolveCurrentPage();

		$perPage = $perPage ?: $this->model->getPerPage();

		$this->skip(($page - 1) * $perPage)->take($perPage + 1);

		return new Paginator($this->get($columns), $perPage, $page, [
			'path' => Paginator::resolveCurrentPath(),
		]);
	}
}