<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;

class ListAppointments extends AdminComponent
{
    protected $listeners = ['deleteConfirmed' => 'deleteConfirmed'];
    protected $queryString = ['status'];

    public $appointmentIdBeingRemoved = null;
    public $status = null;
    public function resetCurrentPage()
    {
        $this->resetPage();
    }

    public function filterAppointmentsByStatus($status = null)
    {
        $this->resetPage();
        $this->status = $status;
    }

    public function confirmAppointmentRemoveal($appointmentId)
    {
        $this->appointmentIdBeingRemoved = $appointmentId;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteConfirmed()
    {
        $appointment = Appointment::findOrFail($this->appointmentIdBeingRemoved);
        $appointment->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'Appointment deleted successfully']);
    }

    public function render()
    {
        $appointments = Appointment::with('client')
            ->when($this->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate($this->rowPerpage);

        $appointmentsCrount = Appointment::count();
        $scheduledAppointmentsCrount = Appointment::where('status', 'scheduled')->count();
        $closedAppointmentsCrount = Appointment::where('status', 'closed')->count();

        return view(
            'livewire.admin.appointments.list-appointments',
            [
                'appointments' => $appointments,
                'appointmentsCount' => $appointmentsCrount,
                'scheduledAppointmentsCount' => $scheduledAppointmentsCrount,
                'closedAppointmentsCount' => $closedAppointmentsCrount
            ]
        );
    }
}
