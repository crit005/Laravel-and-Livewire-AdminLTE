<div class="col-lg-3 col-6">
    <div class="small-box bg-info">
        <div class="inner">
            <div class="d-flex justify-content-between">
                <h3 wire:loading.remove.delay>{{$appointmentsCount}}</h3>
                <div wire:loading.delay>
                    <x-animations.ballbeat/>
                </div>
                <select class="rounded border-0 px-1" style="height: 2rem; outline: 2px solid transparent;"
                    wire:change='getAppointmentsCount($event.target.value)'>
                    <option value="">All</option>
                    <option value="scheduled">Scheduled</option>
                    <option value="closed">Closed</option>
                </select>
            </div>
            <p>Appointments</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">View Appointments <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>