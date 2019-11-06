<?php

namespace App\Jobs;

use App\Models\Timetable;
use App\Scopes\SchoolScope;
use App\Services\GeneticAlgorithm\TimetableGA;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateTimetables implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $timetable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::info('Generating timetable');
        SchoolScope::$schoolId = $this->timetable->school_id;
        $timetableGA = new TimetableGA($this->timetable);
        $timetableGA->run();
    }
}
