<?php

namespace App\Models;

use App\Scopes\SchoolScope;
use Illuminate\Notifications\Notifiable;

class Professor extends Model
{
    use Notifiable;

    /**
     * DB table this model uses
     *
     * @var string
     */
    protected $table = 'professors';

    /**
     * Non-mass assignable fields
     */
    protected $guarded = ['id'];

    /**
     * Declare relationship between a professor and the courses
     * he or she teaches
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'courses_professors', 'professor_id', 'course_id');
    }

    /**
     * Declare relationship between a professor and the timeslots that he or she
     * is not available
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unavailable_timeslots()
    {
        return $this->hasMany(UnavailableTimeslot::class, 'professor_id');
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
