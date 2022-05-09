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
                    <form wire:submit.prevent="createAppointment" autocomplete="off">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New Appointment</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="client">Client:</label>
                                            <select class="form-control" wire:model.defer="state.client_id">
                                                <option value="">Select Client</option>
                                                @foreach ($clients as $client)
                                                <option value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date:</label>
                                            <div wire:ignore class="input-group date" id="appointmentDate"
                                                data-target-input="nearest" data-appointmentdate="@this">
                                                <input wire:model.lazy="state.date" type="text"
                                                    class="form-control datetimepicker-input"
                                                    data-target="#appointmentDate" id="appointmentDateInput">
                                                <div class="input-group-append" data-target="#appointmentDate"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Appointment Time:</label>
                                            <div wire:ignore class="input-group date" id="appointmentTime"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#appointmentTime" wire:model.defer="state.time"
                                                    id="appointmentTimeInput">
                                                <div class="input-group-append" data-target="#appointmentTime"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text">
                                                        <i class="far fa-clock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" wire:ignore>
                                            <label for="note">Note:</label>
                                            <textarea data-note="@this" wire:model='state.note' class="form-control"
                                                id="note"></textarea>
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
        // console.log("{{$date}}");
    $(document).ready(function(){
        
        $('#appointmentDate').datetimepicker({
            format:'L',
            // format:'MM-DD-YYYY',
            defaultDate: "{{array_key_exists('date',$state)?$state['date']:''}}",
            // defaultDate: "11/1/2013",

        });
        $('#appointmentTime').datetimepicker({
            format:'LT',
            defaultDate: "{{array_key_exists('time',$state)?$state['time']:''}}",
        });

        $('#appointmentTime').on('change.datetimepicker',e=>{
            @this.setTime($('#appointmentTimeInput').val()); 
        });

        $('#appointmentDate').on('change.datetimepicker',function(e){
            // call function component 
            //@this.setDate($('#appointmentDateInput').val());                
            // or
            // direct set date from java script
            // -------------------------------------------------
            let date = $(this).data('appointmentdate');                
            eval(date).set('state.date', $('#appointmentDateInput').val());                              
            // -------------------------------------------------
            
        });
        
    });       

    </script>

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