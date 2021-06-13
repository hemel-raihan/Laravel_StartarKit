@extends('layouts.backend.app')

@push('css')

@endpush

@section('content')
                  <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>Menus</div>
                            </div>

                            <div class="page-title-actions">



                      @if($auth->hasPermission('app.menus.create'))

                                <a href="{{route('app.menus.create')  }}" class="btn-shadow mr-3 btn btn-primary">
                                    <i class="fa fa-plus-circle"></i>

                                    Create Menu
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
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($menus as $key=>$menu)
                                            <tr>
                                                <td class="text-center text-muted">#{{$key + 1}}</td>
                                                <td>
                                                   {{$menu->name}}
                                                </td>
                                                <td class="text-center">{{$menu->description}}</td>


                                                <td class="text-center">

                                                    @if($auth->hasPermission('app.menus.builder'))
                                                    <a href="{{route('app.menus.builder',$menu->id)}}" class="btn btn-success btn-sm">
                                                       <i class="fas fa-list-ul"></i>
                                                       <span>Builder</span>
                                                    </a>
                                                    @endif

                                                    @if($auth->hasPermission('app.menus.edit'))
                                                    <a href="{{route('app.menus.edit',$menu->id)}}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                        <span>Edit</span>
                                                     </a>
                                                     @endif

                                                    @if($auth->hasPermission('app.menus.destroy'))
                                                    @if($menu->deletable == true)
                                                    <button class="btn btn-danger waves effect" type="button"
                                                        onclick="deletepost$menu({{ $menu->id}})" >
                                                        <li class="material-icons">delete</li>
                                                        </button>
                                                        <form id="deleteform-{{$menu->id}}" action="{{route('app.menus.destroy',$menu->id)}}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                        </form>

                                                        @endif
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
    function deletepost$menu(id)
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
