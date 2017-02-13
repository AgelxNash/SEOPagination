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
		$this->app->bind('db.connection.mysql', function($app, $parameters) {
          list($connection, $database, $prefix, $config) = $parameters;
          return new \AgelxNash\SEOPagination\Connection\MySql($connection, $database, $prefix, $config);
		});

		$this->app->bind('db.connection.pgsql', function($app, $parameters) {
			list($connection, $database, $prefix, $config) = $parameters;
			return new \AgelxNash\SEOPagination\Connection\Postgres($connection, $database, $prefix, $config);
		});

		$this->app->bind('db.connection.sqlite', function($app, $parameters) {
			list($connection, $database, $prefix, $config) = $parameters;
			return new \AgelxNash\SEOPagination\Connection\SQLite($connection, $database, $prefix, $config);
		});

		$this->app->bind('db.connection.sqlsrv', function($app, $parameters) {
			list($connection, $database, $prefix, $config) = $parameters;
			return new \AgelxNash\SEOPagination\Connection\SqlServer($connection, $database, $prefix, $config);
		});


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
