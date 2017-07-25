<?php

namespace Modules\User\Traits;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

trait Filter
{
	private $perPage = 20;

	private $orderBy = 'created_at';

	private $order = 'DESC';

	private $filters = array();

	private $perPageArray = array(20, 50, 100);

	public function getFilters()
    {
    	return $this->filters;
    }

    public function setFilters( $filters )
    {
    	$this->filters = $filters;
    }

    public function getPerPage()
    {
    	return $this->perPage;
    }

    public function setPerPage( $perPage )
    {
    	if( $perPage ) {
    		$this->perPage = $perPage;
    	}
    }

    public function getOrderBy()
    {
    	return $this->orderBy;
    }

    public function setOrderBy( $orderBy = '' )
    {
    	if( $orderBy ) {
    		$this->orderBy = $orderBy;
    	}
    }

    public function getOrder()
    {
    	return $this->order;
    }

    public function setOrder( $order = '' )
    {
    	if( $order ) {
    		$this->order = $order;
    	}
    }

    public function getPerPageArray()
    {
    	return $this->perPageArray;
    }

    public function setPerPageArray(array $array)
    {
    	$this->perPageArray = $array;
    }

    public function showing( $model )
    {
    	return 'Showing '.$model->firstItem().'-'.$model->lastItem().' of '.$model->total();
    }
    
    // Filter results
    public function filter($model, $params = array())
    {
        $params = empty($params) ? request()->all() : $params;
        $filters = $this->getFilters();
        
        foreach($params as $key => $val)
        {
            if( $val && isset( $filters[$key] ) )
            {
                $operator = $filters[$key]['operator'];
                switch( $operator )
                {
                    case '=':
                    case '>=':
                    case '<=':
                    case '!=':
                    case '<>';
                    $model->where($filters[$key]['key'], $operator, $val);
                    break;

                    case 'like':
					case 'not like':                    
                    $model->where($filters[$key]['key'], $operator, '%'.$val.'%');
                    break;

                    case 'in':
                    $model->whereIn($filters[$key]['key'], $filters[$key]['values']);
                    break;

                    case 'not in':
                    $model->whereNotIn($filters[$key]['key'], $filters[$key]['values']);
                    break;

                    case 'between':
                    $model->whereBetween($filters[$key]['key'], $filters[$key]['values']);
                    break;

                    case 'not between':
                    $model->whereNotBetween($filters[$key]['key'], $filters[$key]['values']);
                    break;

                    case 'null':
                    $model->whereNull($filters[$key]['key']);
                    break;

                    case 'not null':
                    $model->whereNotNull($filters[$key]['key']);
                    break;

                    default:
                    break;
                }
            }
        }

        return $model->orderBy($this->getOrderBy(), $this->getOrder())->paginate( $this->getPerPage() );
    }
}