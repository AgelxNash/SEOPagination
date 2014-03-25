<?php namespace AgelxNash\SEOPagination;

class PaginationServiceProvider extends \Illuminate\Pagination\PaginationServiceProvider{

    public function boot(){
        $this->package('agelxnash/seopagination', 'seopagination', dirname(dirname(dirname(__FILE__))));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){
        $this->app['paginator'] = $this->app->share(function($app){
            $paginator = new Environment($app['request'], $app['view'], $app['translator']);

            $paginator->setViewName($app['config']['view.pagination']);
            $paginator->setActionOnError($app['config']->get('seopagination::action_on_error','out'));
            $paginator->setErrorStatus($app['config']->get('seopagination::error_status','307'));
			$paginator->setKeepQuery($app['config']->get('seopagination::keep_query', false));
            return $paginator;
        });
    }
}