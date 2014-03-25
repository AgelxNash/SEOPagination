<?php namespace AgelxNash\SEOPagination;

use App, Redirect, Request, Input;

class Validation{
    /**
     * @param Paginator $pages
     * @return bool|\Illuminate\Http\RedirectResponse|\Illuminate\Pagination\Paginator
     */
    public static function checkPaginate(Paginator &$pages){
        $flag = false;
        $request = Request::get($pages->getEnvironment()->getPageName());
        if($pages->isEmpty() || (1==$pages->getCurrentPage() && !is_null($request) && (int)$request<=1)){
			if($pages->getEnvironment()->getKeepQuery()){
                $query = array_except( Input::query(), $pages->getEnvironment()->getPageName() );
                $pages->appends($query);
            }
            $action = $pages->getEnvironment()->getActionOnError();
            switch($action){
                case 'abort':{
                    $flag = App::abort(404);
                    break;
                }
				case 'first':{
                    $flag = Redirect::to($pages->getUrl(0), $pages->getEnvironment()->getErrorStatus());
                }
                case 'out':{
                    $url = (1 == $pages->getCurrentPage()) ? 0 : $pages->getLastPage();
                    $flag = Redirect::to($pages->getUrl($url), $pages->getEnvironment()->getErrorStatus());
                    break;
                }
                default:{
                }
            }
        }
        return $flag;
    }
}