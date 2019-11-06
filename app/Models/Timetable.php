<?php

namespace App\Models;

use App\Scopes\SchoolScope;

class Timetable extends Model
{
    /**
     * Table used by this model
     *
     * @var string
     */
    protected $table = 'timetables';

    /**
     * Non mass assignable fields
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Days used by this timetable
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function days()
    {
        return $this->belongsToMany(Day::class, 'timetable_days', 'timetable_id', 'day_id');
    }

    /**
     * Schedules for professors created out of this timetable
     */
    public function schedules()
    {
        return $this->hasMany(ProfessorSchedule::class, 'timetable_id');
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
