<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;

class ListAppointments extends AdminComponent
{     
    public function resetCurrentPage()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $appointments = Appointment::latest()->paginate($this->rowPerpage);
        return view('livewire.admin.appointments.list-appointments',['appointments'=>$appointments]);
    }
}
