<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\Professor;
use App\Notifications\NewTimetablesGenerated;

class NotifyProfessors implements ShouldQueue
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
        $professorIds = $this->timetable->schedules()->pluck('professor_id');
        \Log::info($professorIds);

        $notifiableProfessors = Professor::whereNotNull('email')
            ->where('email', '!=', '')
            ->whereIn('id', $professorIds)
            ->get();

        foreach ($notifiableProfessors as $professor) {
            $professor->notify(new NewTimetablesGenerated($this->timetable));
        }
    }
}
