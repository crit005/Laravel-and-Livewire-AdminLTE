<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UpdateAppointmentForm extends Component
{
    public $state = [];
    public $appointment;

    public function mount(Appointment $appointment)
    {
        // dd($appointment);
        $this->appointment = $appointment;
        $this->state = $appointment->toArray();
        // dd($this->state);
        
    }

    public function updateAppointment()
    {
        // $this->state['status'] = 'opent';
        // $this->state['time'] = date("H:i:s", strtotime($this->state['time']));

        // validation
        Validator::make(
            $this->state,
            [
                'client_id' => 'required',
                'date' => 'required',
                'time' => 'required',
                'note' => 'nullable',
                'status' => 'required|in:SCHEDULED,CLOSED'
            ],
            [ // message
                // 'client_id.required'=>'Client is required!',
            ],
            [ // attributes
                'client_id' => 'Client',
                'time' => 'Appointment Time',
                'date' => 'Appointment Date',
                'status' => 'Status'
            ]
        )->validate();

        // dd($this->state);

        $this->appointment->update($this->state);
        
        $this->dispatchBrowserEvent('alert', ['message' => 'Appointment Update successfully!']);
    }
    

    public function render()
    {
        $clients = Client::all();
        return view('livewire.admin.appointments.update-appointment-form', [
            'clients' => $clients,
        ]);
    }
}
