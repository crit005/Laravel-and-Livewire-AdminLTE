<div>
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
                    <div class="d-flex justify-content-end mb-2">
                        <a href="{{route('admin.appointments.create')}}">
                        <button class="btn btn-primary">
                            <i class="fa fa-plus-circle mr-2"></i>Add New Appintment
                        </button>
                        </a>
                        
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
                                            <option value="{{$appointments->total()}}">--All--</option>
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
                                        <th scope="col">#</th>
                                        <th scope="col">Client Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Option</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <th scope="row">{{ (($page-1)*$rowPerpage)}}</th>
                                        <td>name</td>
                                        <td>date</td>
                                        <td>time</td>
                                        <td>status</td>
                                        <td>
                                            <a href="">
                                                <i class="fa fa-edit mr-2"></i>
                                            </a>
                                            <a href="">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
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

</div>