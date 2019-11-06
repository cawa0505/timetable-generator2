<?php

namespace App\Models;

class School extends Model
{
    /**
     * DB table this model uses
     *
     * @var string
     */
    protected $table = 'schools';

    /**
     * Fields to be protected from mass assignment
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
    *   define relationship between school and his professors
    *
    */

    public function professors(){
        return $this->hasMany(Professor::class);
    }

    public function timetables(){

        return $this->hasMany(Timetable::class);
    }

}
