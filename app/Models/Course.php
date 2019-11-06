<?php

namespace App\Models;

use App\Scopes\SchoolScope;
use DB;
class Course extends Model
{
    /**
     * The DB table used by this model
     *
     * @var string
     */
    protected $table = 'courses';

    /**
     * The fields that should not be mass assigned
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Relations of this model
     *
     * @var array
     */
    protected $relations = ['professors', 'classes'];

    /**
     * Fields that a keyword search should be carried on
     *
     * @var array
     */
    protected $searchFields = ['name', 'course_code'];

    /**
     * Declare a relationship between this course and the
     * professors that teach it
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function professors()
    {
        return $this->belongsToMany(Professor::class, 'courses_professors', 'course_id', 'professor_id');
    }

    /**
     * Declare a relationship between this course and the classes
     * that offer it
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function classes()
    {
        return $this->belongsToMany(CollegeClass::class, 'courses_classes', 'course_id', 'class_id');
    }


    /**
     * Get courses with no professors set up for them
     *
     */
    public function scopeHavingNoProfessors($query)
    {
        return $query->has('professors', '<', 1);
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
