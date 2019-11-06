<?php

namespace App\Models;

class UnavailableTimeslot extends Model
{
    protected $table = 'unavailable_timeslots';

    protected $guarded = ['id'];

    /**
     * Get the day this unavailable period exists in
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function day()
    {
        return $this->belongsTo(Day::class, 'day_id');
    }

    /**
     * Get the timeslot this unavailable period exists in
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function timeslot()
    {
        return $this->belongsTo(Timeslot::class, 'timeslot_id');
    }
}
