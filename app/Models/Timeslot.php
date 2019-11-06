<?php

namespace App\Models;

use App\Scopes\SchoolScope;

class Timeslot extends Model
{
    protected $table = 'timeslots';

    protected $guarded = ['id'];

    /**
     * Determine whether a given period  is within
     * the period of this timeslot
     *
     * @param string $timePeriod The time period
     * @return Boolean Value of test
     */
    public function containsPeriod($timePeriod)
    {
        $edgesA = self::getParts($this->time);
        $edgesB = self::getParts($timePeriod);

        return (($edgesB[0] >= $edgesA[0]) && $edgesB[2] <= $edgesA[2]);
    }

    /**
     * Get the beginning and end of a given time period
     *
     * @param string $timePeriod Time period
     * @return array Parts of given time period
     */
    public static function getParts($timePeriod)
    {
        preg_match('/(0?\d{1,2}):(\d{2})\s*\-\s*(\d{2}):(\d{2})/', $timePeriod, $matches);

        return array_slice($matches, 1);
    }

    /**
     * Generate a time period string
     *
     * @param string $from From section of period
     * @param string $to   To section of period
     */
    public static function createTimePeriod($from, $to)
    {
        return $from . ' - ' . $to;
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
