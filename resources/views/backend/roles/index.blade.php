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
                                <div>Roles</div>
                            </div>
                            <div class="page-title-actions">



                      @if($auth->hasPermission('app.roles.create'))

                                <a href="{{route('app.roles.create')  }}" class="btn-shadow mr-3 btn btn-primary">
                                    <i class="fa fa-plus-circle"></i>

                                    Create Role
                                </a>

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
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Permissions</th>
                                                <th class="text-center">Updated At</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($roles as $key=>$role)
                                            <tr>
                                                <td class="text-center text-muted">#{{$key}}</td>
                                                <td class="text-center">{{$role->name}}</td>
                                                <td class="text-center">
                                                    @if($role->permissions->count() > 0 )
                                                    <span class="badge badge-info">{{$role->permissions->count()}}</span>
                                                    @else
                                                    <span class="badge badge-danger">No Permission Found :(</span>
                                                    @endif

                                                </td>
                                                <td class="text-center">{{$role->updated_at->diffForHumans()}}</td>

                                                <td class="text-center">

                                                    @if($auth->hasPermission('app.roles.edit'))
                                                    <a href="{{route('app.roles.edit',$role->id)}}" class="btn btn-info btn-sm">
                                                       <i class="fas fa-edit"></i>
                                                       <span>Edit</span>
                                                    </a>
                                                    @endif


                                                    @if($auth->hasPermission('app.roles.destroy'))

                                                    <button class="btn btn-danger waves effect" type="button"
                                                        onclick="deletepost$role({{ $role->id}})" >
                                                        <li class="material-icons">delete</li>
                                                        </button>
                                                        <form id="deleteform-{{$role->id}}" action="{{route('app.roles.destroy',$role->id)}}" method="POST" style="display: none;">
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
    function deletepost$role(id)
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
