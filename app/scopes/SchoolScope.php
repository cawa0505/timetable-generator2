<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Auth;

class SchoolScope implements Scope
{
    public static $schoolId ;

    public function __construct(){
        self::$schoolId = Auth::user()->school->id;
    }
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('school_id', '=', self::$schoolId);
    }

    public function setSchoolId(int $schoolId){
        self::$schoolId = $schoolId;
    }

}