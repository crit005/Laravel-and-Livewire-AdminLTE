<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0 text-dark">Appointments</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="">Appointments</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form wire:submit.prevent="updateAppointment" autocomplete="off">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Update Appointment</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="client">Client:</label>
                                            <select class="form-control @error('client_id') is-invalid @enderror"
                                                wire:model.defer="state.client_id">
                                                <option value="">Select Client</option>
                                                @foreach ($clients as $client)
                                                <option value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                @error('client_id')
                                                {{$message}}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointmentDate">Appointment Date:</label>
                                            <div class="input-group mb-3">
                                                <x-datepicker wire:model.defer="state.date" id="appointmentDate" :error="'date'"/>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i
                                                            class="far fa-calendar"></i></span>
                                                </div>
                                                @error('date')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointmentTime">Appointment Time:</label>
                                            <div class="input-group mb-3">
                                                <x-timepicker wire:model.defer="state.time" id="appointmentTime"
                                                    :error="'time'" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                </div>
                                                @error('time')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" wire:ignore>
                                            <label for="note">Note:</label>
                                            <textarea data-note="@this" wire:model.defer='state.note' class="form-control"
                                                id="note">
                                                {{-- html formate content with {{!! $value !!}} --}}
                                            {!! $state['note'] !!}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status:</label>
                                            <select class="form-control @error('status')
                                                is-invalid
                                            @enderror" wire:model.defer="state.status">
                                                <option value="">Select Status</option>
                                                <option value="SCHEDULED">Scheduled</option>
                                                <option value="CLOSED">Closle</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                @error('status')
                                                {{$message}}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="button" class="btn btn-secondary"><i class="fa fa-times mr-1"></i>
                                    Cancel</button>
                                <button type="submit" id="save" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                                    Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    @push('js')    
    <script>
        ClassicEditor
        .create( document.querySelector( '#note' ) )
        .then(
            editor =>{
                // editor.model.document.on('change:data', ()=>{
                //     let note = $('#note').data('note');
                //     eval(note).set('state.note', editor.getData());
                // })
                document.querySelector('#save').addEventListener('click',()=>{
                    let note = $('#note').data('note');
                    eval(note).set('state.note', editor.getData());
                });
            }
        )
        .catch( error => {
            console.error( error );
        } );
    </script>
    @endpush


</div>