@push('js')
<script>
    function resetCurrentPage(){
         @this.resetCurrentPage();
        }

        window.addEventListener('show-delete-confirmation',e =>{
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('deleteConfirmed');
                // Swal.fire(
                // 'Deleted!',
                // 'Your file has been deleted.',
                // 'success'
                // )
            }
            })
        });

    window.addEventListener('alert',evnet=>{
        toastr.success(event.detail.message, 'Success!');
    });

    window.addEventListener('deleted',event=>{
        Swal.fire(
            'Deleted!',
            event.detail.message,
            'success'
            )
    });
</script>
@endpush