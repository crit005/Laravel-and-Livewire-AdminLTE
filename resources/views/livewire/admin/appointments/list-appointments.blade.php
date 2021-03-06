<div>
    <x-loading-indicator />
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Appointments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard.home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Appointments</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>
                    <i class="fa fa-check-circle mr-2"></i>
                    {{session('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <a href="{{route('admin.appointments.create')}}">
                                <button class="btn btn-primary">
                                    <i class="fa fa-plus-circle mr-2"></i>Add New Appintment
                                </button>
                            </a>
                            @if($selectedRows)
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-default">Bulk Action</button>
                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                    data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a wire:click.prevent='deleteSelectedRows' class="dropdown-item" href="#">Delete Selected</a>
                                    <a wire:click.prevent='markAllAsScheduled' class="dropdown-item" href="#">Mark as Scheduled</a>
                                    <a wire:click.prevent='markAllAsClosed' class="dropdown-item" href="#">Mark as Closed</a>                                
                                </div>
                            </div>
                            <span class="ml-2">selected {{count($selectedRows)}} {{Str::plural('appointment',count($selectedRows))}}</span>
                            @endif
                        </div>

                        <div class="btn-group">
                            <button wire:click='filterAppointmentsByStatus()' type="button" class="btn 
                            {{is_null($status)? 'btn-secondary': 'btn-default'}} ">
                                <span class="mr-1">All</span>
                                <span class="badge badge-pill badge-info">{{$appointmentsCount}}</span>
                            </button>

                            <button wire:click='filterAppointmentsByStatus("scheduled")' type="button"
                                class="btn {{$status=='scheduled'? 'btn-secondary': 'btn-default'}} ">
                                <span class="mr-1">Scheduled</span>
                                <span class="badge badge-pill badge-primary">{{$scheduledAppointmentsCount}}</span>
                            </button>

                            <button wire:click='filterAppointmentsByStatus("closed")' type="button"
                                class="btn {{$status=='closed'? 'btn-secondary': 'btn-default'}} ">
                                <span class="mr-1">Closed</span>
                                <span class="badge badge-pill badge-success">{{$closedAppointmentsCount}}</span>
                            </button>
                        </div>


                    </div>
                    <div class="card">
                        <div class="card-header">
                            @if (!empty($appointments))
                            <div class="d-flex flex-row-reverse">
                                <div class="p-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">
                                                <i class="far fa-file-alt"></i>
                                            </label>
                                        </div>
                                        <select {{-- wire:change='resetCurrentPage' --}} {{--
                                            wire:click="resetCurrentPage($event.target.value)" --}}
                                            onchange="resetCurrentPage()" name="row_perpage" id="row_perpage"
                                            wire:model.lazy='rowPerpage' class="custom-select">
                                            <option value="{{$appointmentsCount}}">--All--</option>
                                            <option value="3">3</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="500">500</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            @endif
                        </div>
                        <div class="card-body">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="todoCheck2"
                                                value=""
                                                wire:model='selectPageRows'>
                                                <label for="todoCheck2">
                                                </label>
                                            </div>
                                        </th>
                                        <th scope="col">#</th>
                                        <th scope="col">Client Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)
                                    <tr>
                                        <th scope="row">
                                            <div class="icheck-primary d-inline">
                                                <input wire:model="selectedRows" value="{{$appointment->id}}" type="checkbox" id="{{$appointment->id}}">
                                                <label for="{{$appointment->id}}">
                                                </label>
                                            </div>
                                        </th>
                                        <th scope="row">{{ (($page-1)*$rowPerpage)+$loop->iteration}}</th>
                                        <td>{{$appointment->client->name}}</td>
                                        {{-- <td>{{$appointment->date->toFormattedDate()}}</td>
                                        <td>{{$appointment->time->toFormattedTime()}}</td> --}}
                                        <td>{{$appointment->date}}</td>
                                        <td>{{$appointment->time}}</td>
                                        <td>

                                            {{-- @if ($appointment->status === 'SCHEDULED')
                                            <span class="badge badge-primary">SCHEDULED</span>
                                            @elseif($appointment->status === 'CLOSED')
                                            <span class="badge badge-success">CLOSED</span>
                                            @endif --}}
                                            {{-- or --}}
                                            {{-- <span
                                                class="badge badge-{{$appointment->StatusBadge}}">{{$appointment->status}}</span>
                                            --}}
                                            {{-- or --}}
                                            <span
                                                class="badge badge-{{$appointment->status_badge}}">{{$appointment->status}}</span>

                                        </td>
                                        <td>
                                            <a href="{{route('admin.appointments.edit',$appointment)}}">
                                                <i class="fa fa-edit mr-2"></i>
                                            </a>
                                            <a href=""
                                                wire:click.prevent='confirmAppointmentRemoveal({{$appointment->id}})'>
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {{-- @dump($selectedRows) --}}
                            @if (!empty($appointments))
                            <div class="d-flex justify-content-center mt-2">
                                {{$appointments->links()}}
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content -->
    <x-confirmation-alert />

</div>