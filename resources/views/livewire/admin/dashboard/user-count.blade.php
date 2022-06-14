<div class="col-lg-3 col-6">
    <div class="small-box bg-success">
        <div class="inner">
            <div class="d-flex justify-content-between">
                <h3 wire:loading.remove.delay>{{$usersCount}}</h3>
                <div wire:loading.delay>
                    <x-animations.ballbeat />
                </div>
                <select class="rounded border-0 px-1" style="height: 2rem; outline: 2px solid transparent;"
                    wire:change='getUsersCount($event.target.value)'>
                    <option value="TODAY">Today</option>
                    <option value="30">30 days</option>
                    <option value="60">60 days</option>
                    <option value="360">360 days</option>
                    <option value="MTD">Month to Date</option>
                    <option value="YTD">Year to Date</option>

                </select>
            </div>
            <p>Users</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">View Users <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>