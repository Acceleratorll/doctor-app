<a href="{{ route('admin.jadwal.edit', ['jadwal' => $id]) }}"class="edit btn btn-success edit">
    Edit
</a>
@csrf
@method("DELETE")
<button id="delete" data-id="{{ $id }}" data-name="{{ $doctor }}" data-original-title="Delete" class="delete btn btn-danger">
Delete
</button>
<form action="{{ route('admin.jadwal.destroy',['jadwal' => $id]) }}" id="deleteForm" method="post">
    @csrf
    @method("DELETE")
</form>

<script>
    $(document).ready(function(){
        $('.delete').on('click', function () {
            var deleteButton = $(this);
            var defaultId = deleteButton.data('id');
    
            Swal.fire({
                title: 'Delete Schedule',
                text: 'Are you sure you want to delete this schedule?',
                type: 'warning',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                console.log(result);
                if (result.value == true) {
                    console.log('confirmed');
                    $.ajax({
                        type: 'POST',
                        url: `{{ route("admin.jadwal.destroy", ["jadwal" => ":scheduleId"]) }}`.replace(':scheduleId', defaultId),
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function (response) {
                            Swal.fire({
                                title: 'schedule Deleted Successfully',
                                type: 'success',
                                icon: 'success',
                                timer: 1700,
                            });
                            Swal.showLoading();
    
                            $('#table').DataTable().ajax.reload();
                        },
                        error: function (error) {
                            console.error('Error:', error);
                            Swal.fire('Error', 'Failed to delete schedule', 'error');
                        },
                    });
                }
            });
        });
    });
    </script>