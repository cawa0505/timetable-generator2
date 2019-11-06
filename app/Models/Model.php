<?php

namespace App\Models;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Auth;

class Model extends Eloquent
{
    protected $authUser;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->authUser = Auth::user();
    }

    /**
     * Make almost all fields mass unsignable
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Relations of this model
     *
     * @var array
     */
    protected $relations = [];

    /**
     * Fields that a keyword search should be carried on
     *
     * @var array
     */
    protected $searchFields = ['name'];

    /**
     * Get the relations of this model
     *
     * @return array Relations of this model
     */
    public function getRelations()
    {
        return $this->relations;
    }

    /**
     * Get the fields of this model that are searchable
     *
     * @return array Fields of this model
     */
    public function getSearchFields()
    {
        return $this->searchFields;
    }
}