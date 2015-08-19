<?php namespace AgelxNash\SEOPagination;

use Illuminate\Support\ServiceProvider;
Use AgelxNash\SEOPagination\Paginator\Paginator;

class PaginationServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$configPath = __DIR__.'/../config/seo-pagination.php';

		// Publish config.
		$this->publishes([$configPath => config_path('seo-pagination.php')], 'config');
	}

	/**
	 * Register service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		Paginator::currentPathResolver(function()
		{
			return $this->app['request']->url();
		});

		Paginator::currentPageResolver(function()
		{
			return $this->app['request']->input('page');
		});

		$configPath = __DIR__.'/../config/seo-pagination.php';
		// Merge config to allow user overwrite.
		$this->mergeConfigFrom($configPath, 'seo-pagination');
	}
}