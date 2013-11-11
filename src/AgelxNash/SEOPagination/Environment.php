<?php namespace AgelxNash\SEOPagination;

class Environment extends \Illuminate\Pagination\Environment{
    protected $actionOnError = null;
    protected $errorStatus  = null;

    /**
     * Get a new paginator instance.
     *
     * @param  array  $items
     * @param  int    $total
     * @param  int    $perPage
     * @return Paginator
     */
    public function make(array $items, $total, $perPage){
        $paginator = new Paginator($this, $items, $total, $perPage);
        return $paginator->setupPaginationContext();
    }

    public function getActionOnError(){
        return $this->actionOnError;
    }
    public function setActionOnError($data){
        $this->actionOnError = $data;
    }

    public function getErrorStatus(){
        return $this->errorStatus;
    }

    public function setErrorStatus($data){
        $this->errorStatus = $data;
    }
}