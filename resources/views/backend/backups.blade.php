@extends('layouts.backend.app')

@push('css')

<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endpush

@section('content')
                  <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-check icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>Backups</div>
                            </div>
                            <div class="page-title-actions">



                          @if($auth->hasPermission('app.backups.index'))

                                <button type="button" onclick="event.preventDefault();
                                               document.getElementById('new-backup-form').submit();" class="btn-shadow mr-3 btn btn-primary">
                                    <i class="fa fa-plus-circle"></i>

                                    Create New Backup
                                </button>
                                <form id="new-backup-form" action="{{route('app.backups.store')}}" method="POST" style="display:none">
                                    @csrf
                                </form>

                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">File Name</th>
                                                <th class="text-center">Size</th>
                                                <th class="text-center">Created At</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($backups as $key=>$backup)
                                            <tr>
                                                <td class="text-center text-muted">#{{$key+1}}</td>
                                                <td class="text-center">{{$backup['file_name']}}</td>
                                                <td class="text-center">{{$backup['file_size']}}</td>
                                                <td class="text-center">{{$backup['created_at']}}</td>

                                                <td class="text-center">

                                                    @if($auth->hasPermission('app.backups.edit'))
                                                    <a href="#" class="btn btn-info btn-sm">
                                                       <i class="fas fa-download"></i>
                                                       <span>Download</span>
                                                    </a>
                                                    @endif


                                                    @if($auth->hasPermission('app.backups.destroy'))

                                                    <button class="btn btn-danger waves effect" type="button"
                                                        onclick="deletepost$backup({{ $key }})" >
                                                        <li class="material-icons">delete</li>
                                                        </button>
                                                        <form id="deleteform-{{$key}}" action="{{route('app.backups.destroy',$backup['file_name'])}}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                        </form>
                                                        @endif
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function deletepost$backup(id)
    {
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
   event.preventDefault();
   document.getElementById('deleteform-'+id).submit();
  }
})
    }
    </script>

@push('js')
<script>
    $(document).ready(function() {
    $('#datatable').DataTable();
} );
</script>
@endpush
