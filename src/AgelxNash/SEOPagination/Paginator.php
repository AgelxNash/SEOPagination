<?php namespace AgelxNash\SEOPagination;

class Paginator extends \Illuminate\Pagination\Paginator{
    public function getUrl($page)
    {
        if($page > 1){
            $parameters = array(
                $this->factory->getPageName() => $page,
            );
        }else{
            $parameters = array();
        }
        // If we have any extra query string key / value pairs that need to be added
        // onto the URL, we will put them in query string form and then attach it
        // to the URL. This allows for extra information like sortings storage.
        if (count($this->query) > 0)
        {
            $parameters = array_merge($parameters, $this->query);
        }
		$q = http_build_query($parameters, null, '&');
		$fragment = $this->buildFragment();

		return $this->factory->getCurrentUrl(). (!empty($q) ? '?' : '') . $q . $fragment;
    }
}