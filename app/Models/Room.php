<?php

namespace App\Models;

use App\Scopes\SchoolScope;

class Room extends Model
{
    /**
     * DB table this model uses
     *
     * @var string
     */
    protected $table = 'rooms';

    /**
     * Fields to be protected from mass assignment
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Declare a relationship between this room and the courses
     * that are allowed to use this room
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'favourite_rooms', 'room_id', 'course_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SchoolScope());
    }

    /**
     * Declare relationship between a timetable his school
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function setSchoolIdAttribute($value){
        $this->attributes['school_id'] = $this->authUser->school->id;
    }
}
