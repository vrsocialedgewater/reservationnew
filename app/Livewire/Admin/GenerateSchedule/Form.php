<?php

namespace App\Livewire\Admin\GenerateSchedule;

use App\Models\BookingSchedule;
use App\Models\Day;
use App\Models\GenerateSchedule;
use App\Models\Location;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;
    public $name,$service_id,$days,$services,$duration,$start_time,$end_time,$day = [];


    protected $rules = [
        'name' => 'required|min:4|max:128',
        'service_id' => 'required|integer|between:1,9999999',
        'duration' => 'required|integer|between:1,540',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i',
        'day.*' => 'required|integer|between:1,9999999'
    ];

    public function mount(){
        $this->days = Day::get();
        $this->services = Service::orderBy('title', 'ASC')->get();
    }

    public function resetFormFields()
    {
        $this->name = '';
        $this->service_id = '';
    }

    #[On('open-create-form')]
    public function openCreateForm()
    {
        $this->resetFormFields();
    }


    public function store(){
        $validateData = $this->validate();

        try {
            BookingSchedule::where('service_id', $this->service_id)->delete();
            $totalDuration = Carbon::createFromFormat('H:i', @$this->start_time)->diffInMinutes(@$this->end_time);
            $blocks = (int) $totalDuration/$this->duration;
            foreach($this->day as $it){
                if($it){
                    $it = (int) $it;
                    $scheduleDay = $this->days->find($it);
                    $schedules = [];
                    $nextStart = $this->start_time;
                    $nextEnd = Carbon::createFromFormat('H:i', $nextStart)->addMinutes(((int)$this->duration)-1)->format("H:i");
                    for($i = 0; $i < $blocks; $i++){
                        $schedules[] = [
                            'name' => $scheduleDay->name . " - " . $i+1,
                            'start_time' => $nextStart,
                            'end_time' => $nextEnd,
                            'day_id' => $it,
                            'user_id' => Auth::id(),
                            'service_id' => $this->service_id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                        $nextStart = Carbon::createFromFormat('H:i', $nextStart)->addMinutes((int)$this->duration)->format("H:i");
                        $nextEnd = Carbon::createFromFormat('H:i', $nextStart)->addMinutes(((int)$this->duration)-1)->format("H:i");
                    }
                    BookingSchedule::insert($schedules);
                }

            }

            $validateData = array_merge($validateData, [
                'user_id' => Auth::id(),
            ]);
            $scheduleGenerate = GenerateSchedule::create($validateData);

            $this->dispatch('schedule-generated', schedule_generate: $scheduleGenerate);
            $this->resetFormFields();
            session()->flash('form-success', 'Schedule generated successfully.');
            return $scheduleGenerate;
        } catch (Exception $e) {
            session()->flash('form-error', 'Data storing failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('admin.generate-schedule.form');
    }
}
