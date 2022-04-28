<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\Client;
use Livewire\Component;

class CreateAppointmentForm extends Component
{
    public $state=[];
    public $date ='04/27/2022';

    public function createAppointment()
    {        
        // dd($this->state);
        $this->state['status'] = 'opent';
        // $this->state['time'] = date("H:i:s", strtotime($this->state['time']));

        Appointment::create($this->state);

        $this->dispatchBrowserEvent('alert',['message'=>'Appointment created successfully!']);
        
    }
    public function setDate($date)
    {
        $this->state['date']=$date;
    }
    public function setTime($time)
    {
        $this->state['time']=$time;
    }

    public function render()
    {        
        $clients = Client::all();
        return view('livewire.admin.appointments.create-appointment-form',[
            'clients'=>$clients,
        ]);
    }
}
