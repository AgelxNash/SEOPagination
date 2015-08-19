<?php namespace AgelxNash\SEOPagination\Paginator;

use App, Redirect, Request;
Use AgelxNash\SEOPagination\PageNotFoundException;
use Doctrine\DBAL\Driver\AbstractDriverException;

trait ReplaceUrl{
	protected $actionOnError = 'out';
	protected $errorStatus = 307;
	protected $keepQuery = false;

	/**
	 * Get a URL for a given page number.
	 *
	 * @param  int  $page
	 * @return string
	 */
	public function url($page)
	{
		if($page > 1) {
			$parameters = [$this->pageName => $page];
		}else{
			$parameters = [];
		}
		// If we have any extra query string key / value pairs that need to be added
		// onto the URL, we will put them in query string form and then attach it
		// to the URL. This allows for extra information like sortings storage.
		if (count($this->query) > 0)
		{
			$parameters = array_merge($this->query, $parameters);
		}
		$q = http_build_query($parameters, null, '&');
		$fragment = $this->buildFragment();
		return $this->path.(!empty($q) ? '?' : '') . urldecode($q) . $fragment;
	}

	public function checkPaginate($keepQuery = null){
		$flag = true;

		$request = Request::get($this->getPageName());
		$cPage = $this->currentPage();
		if(($this->isEmpty() && 1!=$cPage) || (1==$cPage && !is_null($request) && (int)$request!=$cPage)){
			if(is_null($keepQuery)){
				$keepQuery = $this->getKeepQuery();
			}
			if($keepQuery){
				$query = array_except( Request::query(), $this->getPageName() );
				$this->appends($query);
			}
			$action = $this->getActionOnError();
			switch($action){
				case 'abort':{
					App::abort(404, 'asd');
					break;
				}
				case 'first':{
					$flag = Redirect::to($this->url(0), $this->getErrorStatus());
					break;
				}
				case 'out':{
					$url = (1 == $this->currentPage()) ? 0 : $this->lastPage();
					$flag = Redirect::to($this->url($url), $this->getErrorStatus());
					break;
				}
				default:{
					throw new PageNotFoundException('zxc');
				}
			}
		}
		return $flag;
	}

	public function getPageName(){
		return $this->pageName;
	}

	public function getActionOnError(){
		return $this->actionOnError;
	}
	public function setActionOnError($data){
		$this->actionOnError = (string) $data;
	}
	public function getErrorStatus(){
		return $this->errorStatus;
	}
	public function setErrorStatus($data){
		$this->errorStatus = (int) $data;
	}
	public function setKeepQuery($data){
		$this->keepQuery = (bool) $data;
	}
	public function getKeepQuery(){
		return $this->keepQuery;
	}
}