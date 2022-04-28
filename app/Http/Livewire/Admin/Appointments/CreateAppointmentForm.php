<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Client;
use Livewire\Component;

class CreateAppointmentForm extends Component
{
    public $state=[];
    public $date ='04/27/2022';

    public function createAppointment()
    {        
        dd($this->state);
    }
    public function setDate($date)
    {
        $this->state['date']=$date;
    }

    public function render()
    {        
        $clients = Client::all();
        return view('livewire.admin.appointments.create-appointment-form',[
            'clients'=>$clients,
        ]);
    }
}
