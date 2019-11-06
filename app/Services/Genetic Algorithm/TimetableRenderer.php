<?php

namespace App\Services\GeneticAlgorithm;

use Storage;

use App\Models\Day as DayModel;
use App\Models\Room as RoomModel;
use App\Models\Course as CourseModel;
use App\Models\Timeslot as TimeslotModel;
use App\Models\CollegeClass as CollegeClassModel;
use App\Models\Professor as ProfessorModel;
use App\Models\ProfessorSchedule;

class TimetableRenderer
{
    /**
     * Create a new instance of this class
     *
     * @param App\Models\Timetable Timetable whose data we are rendering
     */
    public function __construct($timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Generate HTML layout files out of the timetable data
     *
     * Chromosome interpretation is as follows
     * Timeslot, Room, Professor
     *
     */
    public function render()
    {
        $chromosome = explode(",", $this->timetable->chromosome);
        $scheme = explode(",", $this->timetable->scheme);
        $data = $this->generateData($chromosome, $scheme);

        $days = $this->timetable->days()->orderBy('id', 'ASC')->get();
        $timeslots = TimeslotModel::orderBy('rank', 'ASC')->get();
        $classes = CollegeClassModel::all();

        $tableTemplate = '<h3 class="text-center">{TITLE}</h3>
                         <div style="page-break-after: always">
                            <table class="table table-bordered">
                                <thead>
                                    {HEADING}
                                </thead>
                                <tbody>
                                    {BODY}
                                </tbody>
                            </table>
                        </div>';

        $content = "";

        foreach ($classes as $class) {
            $header = "<tr class='table-head'>";
            $header .= "<td>Days</td>";

            foreach ($timeslots as $timeslot) {
                $header .= "\t<td>" . $timeslot->time . "</td>";
            }

            $header .= "</tr>";

            $body = "";

            foreach ($days as $day) {
                $body .= "<tr><td>" . strtoupper($day->short_name) . "</td>";
                foreach ($timeslots as $timeslot) {
                    if (isset($data[$class->id][$day->name][$timeslot->time])) {
                        $body .= "<td class='text-center'>";
                        $slotData = $data[$class->id][$day->name][$timeslot->time];
                        $courseCode = $slotData['course_code'];
                        $courseName = $slotData['course_name'];
                        $professor = $slotData['professor'];
                        $room = $slotData['room'];

                        $body .= "<span class='course_code'>{$courseCode}</span><br />";
                        $body .= "<span class='room pull-left'>{$room}</span>";
                        $body .= "<span class='professor pull-right'>{$professor}</span>";

                        $body .= "</td>";
                    } else {
                        $body .= "<td></td>";
                    }
                }
                $body .= "</tr>";
            }

            $title = $class->name;
            $content .= str_replace(['{TITLE}', '{HEADING}', '{BODY}'], [$title, $header, $body], $tableTemplate);
        }

        $path = 'public/timetables/timetable_' . $this->timetable->id . '.html';
        Storage::put($path, $content);

        $this->timetable->update([
            'file_url' => $path
        ]);
    }

    /**
     * Get an associative array with data for constructing timetable
     *
     * @param array $chromosome Timetable chromosome
     * @param array $scheme Mapping for reading chromosome
     * @return array Timetable data
     */
    public function generateData($chromosome, $scheme)
    {
        $data = [];
        $schemeIndex = 0;
        $chromosomeIndex = 0;
        $groupId = null;

        while ($chromosomeIndex < count($chromosome)) {
            while ($scheme[$schemeIndex][0] == 'G') {
                $groupId = substr($scheme[$schemeIndex], 1);
                $schemeIndex += 1;
            }

            $courseId = $scheme[$schemeIndex];

            $class = CollegeClassModel::find($groupId);
            $course = CourseModel::find($courseId);

            $timeslotGene = $chromosome[$chromosomeIndex];
            $roomGene = $chromosome[$chromosomeIndex + 1];
            $professorGene = $chromosome[$chromosomeIndex + 2];

            $matches = [];
            preg_match('/D(\d*)T(\d*)/', $timeslotGene, $matches);

            $dayId = $matches[1];
            $timeslotId = $matches[2];

            $day = DayModel::find($dayId);
            $timeslot = TimeslotModel::find($timeslotId);
            $professor = ProfessorModel::find($professorGene);
            $room = RoomModel::find($roomGene);

            if (!isset($data[$groupId])) {
                $data[$groupId] = [];
            }

            if (!isset($data[$groupId][$day->name])) {
                $data[$groupId][$day->name] = [];
            }

            if (!isset($data[$groupId][$day->name][$timeslot->time])) {
                $data[$groupId][$day->name][$timeslot->time] = [];
            }

            $data[$groupId][$day->name][$timeslot->time]['course_code'] = $course->course_code;
            $data[$groupId][$day->name][$timeslot->time]['course_name'] = $course->name;
            $data[$groupId][$day->name][$timeslot->time]['room'] = $room->name;
            $data[$groupId][$day->name][$timeslot->time]['professor'] = $professor->name;

            $schemeIndex++;
            $chromosomeIndex += 3;
        }

        return $data;
    }


        /**
     * Get an associative array with data for constructing professor timetable
     *
     * @param $professor Professor
     * @param $timetable Timetable corresponding timetable
     * @return array Schedules data
     */
    public function getProfessorSchedules($professor,$timetable)
    {
       
        $schedules = [];
        $days = DayModel::all();

        foreach ($days as $day) {
            $schedules[$day->short_name] = ProfessorSchedule::with(['timetable', 'professor', 'course', 'day', 'timeslot', 'room', 'college_class'])
                ->where('timetable_id', $timetable->id)
                ->where('professor_id', $professor->id)
                ->where('day_id', $day->id)
                ->join('timeslots', 'timeslots.id', '=', 'professor_schedules.timeslot_id')
                ->orderBy('timeslots.rank')
                ->get();
        } 

        return $schedules;
    }

    public function renderProfessorSchedule($schedules){

        $timeslots = TimeslotModel::orderBy('rank', 'ASC')->get();

        $tableTemplate = '<h3 class="text-center">{TITLE}</h3>
                         <div style="page-break-after: always">
                            <table class="table table-bordered">
                                <thead>
                                    {HEADING}
                                </thead>
                                <tbody>
                                    {BODY}
                                </tbody>
                            </table>
                        </div>';

        $content = "";
        $final="";

        $header = "<tr class='table-head'>";
        $header .= "<td>Days</td>";

        foreach ($timeslots as $timeslot) {
            $header .= "\t<td>" . $timeslot->time . "</td>";
        }

        $header .= "</tr>";

        foreach ($schedules as $day => $schedule) {
            $content.="<tr><td>".$day."</td>";    
            foreach ($timeslots as $key => $timeslot) {
                foreach ($schedules[$day] as $i => $period) {
                    if ($timeslot->id == $period->timeslot->id) {
                        $content .= "<td class='text-center'>";
                            $courseCode = $period->course->course_code;
                            $courseName = $period->course->course_name;
                            $professor = $period->professor;
                            $room = $period->room->name;

                            $content .= "<span class='course_code'>{$courseCode}</span><br />";
                            $content .= "<span class='room pull-left'>{$room}</span>";
                            $content .= "<span class='professor pull-right'>{$professor->name}</span>";

                            $content .= "</td>";
                            break;
                    }else{
                         $content.= "<td></td>";
                    }   
                }
                if(count($schedules[$day])==0)  $content.= "<td></td>";                 
            }
            $content.= "</tr>";
        }

        $title= $this->timetable->name." | ".$professor->name;

        $final .= str_replace(['{TITLE}', '{HEADING}', '{BODY}'], [$title, $header, $content], $tableTemplate);

        $path = 'public/timetables/prof_'.$professor->id.'timetable_' . $this->timetable->id . '.html';
        Storage::put($path, $final);
        $timetableData = $final ;
        $timetableName = $title;
        return view('timetables.view', compact('timetableData', 'timetableName'));
    }

}