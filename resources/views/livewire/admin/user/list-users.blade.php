<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard.home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                        <button wire:click='addNew' class="btn btn-primary">
                            <i class="fa fa-plus-circle mr-2"></i>Add New User
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex flex-row-reverse">
                                <div class="p-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">
                                                <i class="far fa-file-alt"></i>
                                            </label>
                                        </div>
                                        <select 
                                        {{-- wire:change='resetCurrentPage'  --}}
                                        {{-- wire:click="resetCurrentPage($event.target.value)" --}}
                                        onchange="resetCurrentPage()"
                                        name="row_perpage" id="row_perpage"
                                        wire:model.lazy='rowPerpage'
                                            class="custom-select">
                                            <option value="{{$users->total()}}">--All--</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="500">500</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ (($page-1)*$rowPerpage)+$loop->iteration }}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <a href="" wire:click.prevent="edit({{$user}})">
                                                <i class="fa fa-edit mr-2"></i>
                                            </a>
                                            <a href="" wire:click.prevent="confirmUserRemoval({{$user->id}})">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-2">
                                {{$users->links()}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->



        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="form" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form wire:submit.prevent="{{$showEditModal?'updateUser':'createUser'}}" id="inputForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                @if ($showEditModal)
                                <i class="fa fa-edit mr-1"></i> Edit New User
                                @else
                                <i class="fa fa-user mr-1"></i> Add New User
                                @endif
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input wire:model.lazy='state.name' type="text" class="form-control @error('name')
                                    is-invalid
                                @enderror" id="name" placeholder="Enter full name">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input wire:model.lazy='state.email' type="email" class="form-control @error('email')
                                is-invalid
                            @enderror" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input wire:model.lazy='state.password' type="password" class="form-control @error('password')
                                is-invalid
                            @enderror" id="password" placeholder="Password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="passwordConfirmation">Confirm Password</label>
                                <input wire:model.lazy='state.password_confirmation' type="password" class="form-control @error('password_confirmation')
                                    is-invalid
                                @enderror" id="passwordConfirmation" placeholder="Password">
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-times mr-1"></i>Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save mr-1"></i>
                                @if ($showEditModal)
                                Save Change
                                @else
                                Save
                                @endif

                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Confirm delete --}}
        <div wire:ignore.self class="modal fade" id="confirmDelete" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <i class="fas fa-user-minus mr-1"></i> Delete User
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3>Are you sure to delete this user ?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fa fa-times mr-1"></i>Cancel</button>
                        <button wire:click.prevent="deleteUser" type="button" class="btn btn-danger">
                            <i class="fa fa-trash mr-1"></i>
                            Yes
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Confirm delete --}}
    </div>
    <!-- /.content -->
    <script>
        $(document).ready(function(){
            toastr.options={
                "positionClass":"toast-bottom-right",
                "progressBar":true,
                "closeButton": true,
                "timeOut": "3000",
            }          
                
        });
        window.addEventListener('show-form',event=>{
            $('#form').modal({backdrop: 'static', keyboard: false});
        });
        window.addEventListener('hide-form',event=>{
            $('#form').modal('hide');
            toastr.success(event.detail.message,'Success!');
        });
        
        window.addEventListener('show-delete-modal',event=>{
            $('#confirmDelete').modal({backdrop: 'static', keyboard: false});
        });
        window.addEventListener('hide-delete-modal',event=>{
            $('#confirmDelete').modal('hide');
            toastr.success(event.detail.message,'Success!');
        });
            // $('#form').on('show.bs.modal', function (e) {                
            //     @this.state =[];
            // });
       
        function resetCurrentPage(){
            @this.resetCurrentPage();
        }
        
    </script>

</div>