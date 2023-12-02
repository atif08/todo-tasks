<?php

namespace App\Http\Queries;

use App\Models\Task;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskIndexQuery extends QueryBuilder
{
    public function __construct()
    {
        $query = Task::query()
            ->select('id', 'title', 'description','user_id')->with(['user']);

        parent::__construct($query);

        $this->allowedFilters(
            AllowedFilter::partial('title'),
            AllowedFilter::partial('description')
        )->allowedSorts('title','id','description' )
        ->defaultSort('-id');
    }
}
