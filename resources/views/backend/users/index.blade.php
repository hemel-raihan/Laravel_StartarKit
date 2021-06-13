@extends('layouts.backend.app')

@push('css')

@endpush

@section('content')
                  <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>Users</div>
                            </div>
                            <div class="page-title-actions">



                      @if($auth->hasPermission('app.users.create'))

                                <a href="{{route('app.users.create')  }}" class="btn-shadow mr-3 btn btn-primary">
                                    <i class="fa fa-plus-circle"></i>

                                    Create User
                                </a>

                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="table-responsive">
                                    <table id="example" class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Name</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Joined At</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $key=>$user)
                                            <tr>
                                                <td class="text-center text-muted">#{{$key + 1}}</td>
                                                <td>
                                                    <div class="widget-content p-8">
                                                        <div class="widget-content-wrapper">
                                                            <div class=" widget-content-left mr-3">
                                                                <div class="widget-content-left">
                                                                    <img width="40" class="rounded-circle"
                                                                    src="{{ $user->image != 'default.png' ? Storage::disk('public')->url('userphoto/'.$user->image) : config('app.placeholder').'160.png'}}" alt="User Avatar">
                                                                </div>
                                                            </div>
                                                            <div class="widget-content-left flex2">
                                                                <div class="widget-heading">{{$user->name}}</div>
                                                                <div class="widget-subheading opacity-7">
                                                                    @if($user->role)
                                                                       <span class="badge badge-info">{{$user->role->name}}</span>
                                                                    @else
                                                                       <span class="badge badge-danger">No Role Found</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{$user->email}}</td>
                                                <td class="text-center">
                                                    @if($user->status == true)
                                                    <span class="badge badge-info">Active</span>
                                                    @else
                                                    <span class="badge badge-danger">Inactive :(</span>
                                                    @endif

                                                </td>
                                                <td class="text-center">{{$user->created_at->diffForHumans()}}</td>

                                                <td class="text-center">

                                                    <a href="{{route('app.users.show',$user->id)}}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                        <span>Show</span>
                                                     </a>

                                                    @if($auth->hasPermission('app.users.edit'))
                                                    <a href="{{route('app.users.edit',$user->id)}}" class="btn btn-info btn-sm">
                                                       <i class="fas fa-edit"></i>
                                                       <span>Edit</span>
                                                    </a>
                                                    @endif


                                                    @if($auth->hasPermission('app.users.destroy'))

                                                    <button class="btn btn-danger waves effect" type="button"
                                                        onclick="deletepost$user({{ $user->id}})" >
                                                        <li class="material-icons">delete</li>
                                                        </button>
                                                        <form id="deleteform-{{$user->id}}" action="{{route('app.users.destroy',$user->id)}}" method="POST" style="display: none;">
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
    function deletepost$user(id)
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
    $('.example').DataTable();
} );
</script>
@endpush
