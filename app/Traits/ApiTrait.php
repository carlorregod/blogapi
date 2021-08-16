<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ApiTrait {

    // ?included=posts,posts.user,others
    //Abrir ramas de consulta
    public function scopeIncluded(Builder $query) {

        $allowIncluded = collect(['posts','posts.user']);
        // dd( request('included') );
        if(empty(request()->included))
            return;
        $relation = explode(',',request()->included) ;

        foreach ($relation as $key => $rel) {
            if(!$allowIncluded->contains($rel)) //Si está contemplado
                unset($relation[$key]);
        }

        return $query->with($relation);  //Con ello se abre la llave de buscar
    }

    //?filter[name]=li&filter[slug]=as
    //Filtrar por name o slug
    public function scopeFilter(Builder $query) {

        $allowFilter = ['name','slug'];
        // dd( request()->filter );
        if(empty(request('filter')))
            return;
        $filters = request('filter') ; //Ya vendrán como arrays

        foreach ($filters as $filter => $value) {
            if(in_array($filter,$allowFilter)) //Si está contemplado
                $query->where($filter,'LIKE','%'.$value.'%');
        }

        return;

    }

    //?sort[name]&sort[slug]=desc
    public function scopeSort(Builder $query) {
        $allowSort = ['name','slug'];

        if(empty(request('sort')))
            return;

        $sorts = request()->sort;

        foreach ($sorts as $sort => $value) {
            if(in_array($sort,$allowSort)) //Si está contemplado
                if(strtolower($value) != 'desc')
                    $query->orderBy($sort);
                else
                    $query->orderBy($sort,strtolower($value));
        }

        return;
    }

    //?perPage=3
    //?perPage?&page=2
    //Scope paginador
    public function scopeGetOrPaginate(Builder $query) {
        if(!empty(request('perPage'))) {
            $perPage = intval(request('perPage'));
            if($perPage != 0) {
                return $query->paginate($perPage);;
            }
        }

        return $query->get();


    }


}
