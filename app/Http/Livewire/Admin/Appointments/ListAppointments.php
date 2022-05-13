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

    public $selectedRows = [];
    public $selectPageRows = false;

    public function updatedSelectPageRows($value) // execute after $selectPageRows change
    {
        // dd($value);
        if ($value) {
            $this->selectedRows = $this->appointments->pluck('id')->map(function ($id) {
                return (string)$id;
            })->toArray();
        } else {
            // $this->selectedRows = [];
            $this->reset('selectedRows','selectPageRows');
        }
        // dd($this->selectedRows);
    }

    public function deleteSelectedRows()
    {
        // dd($this->selectedRows);
        Appointment::whereIn('id',$this->selectedRows)->delete();
        $this->reset('selectedRows','selectPageRows');
        $this->dispatchBrowserEvent('deleted',['message'=>'All selected appointments got deleted.']);
        
    }

    public function markAllAsScheduled()
    {
        Appointment::whereIn('id',$this->selectedRows)->update(['status'=>'SCHEDULED']);
        $this->reset('selectedRows','selectPageRows');
        $this->dispatchBrowserEvent('updated',['message'=>'Appointments marked as scheduled.']);
    }

    public function markAllAsClosed()
    {
        Appointment::whereIn('id',$this->selectedRows)->update(['status'=>'CLOSED']);
        $this->reset('selectedRows','selectPageRows');
        $this->dispatchBrowserEvent('updated',['message'=>'Appointments marked as closed.']);
    }

    public function getAppointmentsProperty()
    {
        return Appointment::with('client')
            ->when($this->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate($this->rowPerpage);
    }

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
        $appointments = $this->appointments;

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
