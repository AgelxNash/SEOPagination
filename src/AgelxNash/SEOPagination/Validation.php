<?php namespace AgelxNash\SEOPagination;

use App, Redirect, Request;

class Validation{
    /**
     * @param Paginator $pages
     * @return bool|\Illuminate\Http\RedirectResponse|\Illuminate\Pagination\Paginator
     */
    public static function checkPaginate(Paginator &$pages, $keepQuery = null){
        $flag = false;
        $request = Request::get($pages->getFactory()->getPageName());
        $cPage = $pages->getCurrentPage();
        if(($pages->isEmpty() && 1!=$cPage) || (1==$cPage && !is_null($request) && (int)$request!=$cPage)){
            if(is_null($keepQuery)){
                $keepQuery = $pages->getFactory()->getKeepQuery();
            }
            if($keepQuery){
                $query = array_except( Request::query(), $pages->getFactory()->getPageName() );
                $pages->appends($query);
            }
            $action = $pages->getFactory()->getActionOnError();
            switch($action){
                case 'abort':{
                    $flag = App::abort(404);
                    break;
                }
                case 'first':{
                    $flag = Redirect::to($pages->getUrl(0), $pages->getFactory()->getErrorStatus());
                    break;
                }
                case 'out':{
                    $url = (1 == $pages->getCurrentPage()) ? 0 : $pages->getLastPage();
                    $flag = Redirect::to($pages->getUrl($url), $pages->getFactory()->getErrorStatus());
                    break;
                }
                default:{
                    throw new Exceptions\PageNotFound;
                }
            }
        }
        return $flag;
    }
}