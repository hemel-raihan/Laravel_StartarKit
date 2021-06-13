@extends('layouts.backend.app')

@push('css')

@endpush

@section('content')
                  <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>Pages</div>
                            </div>

                            <div class="page-title-actions">



                      @if($auth->hasPermission('app.pages.create'))

                                <a href="{{route('app.pages.create')  }}" class="btn-shadow mr-3 btn btn-primary">
                                    <i class="fa fa-plus-circle"></i>

                                    Create Page
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
                                                <th>Title</th>
                                                <th class="text-center">URL</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Last Modified</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pages as $key=>$page)
                                            <tr>
                                                <td class="text-center text-muted">#{{$key + 1}}</td>
                                                <td>
                                                   {{$page->title}}
                                                </td>
                                                <td class="text-center"><a href=""> {{$page->slug}} </a></td>
                                                <td class="text-center">
                                                    @if($page->status == true)
                                                    <span class="badge badge-info">Active</span>
                                                    @else
                                                    <span class="badge badge-danger">Inactive :(</span>
                                                    @endif

                                                </td>
                                                <td class="text-center">{{$page->updated_at->diffForHumans()}}</td>

                                                <td class="text-center">

                                                    @if($auth->hasPermission('app.pages.edit'))
                                                    <a href="{{route('app.pages.edit',$page->id)}}" class="btn btn-info btn-sm">
                                                       <i class="fas fa-edit"></i>
                                                       <span>Edit</span>
                                                    </a>
                                                    @endif


                                                    @if($auth->hasPermission('app.pages.destroy'))

                                                    <button class="btn btn-danger waves effect" type="button"
                                                        onclick="deletepost$page({{ $page->id}})" >
                                                        <li class="material-icons">delete</li>
                                                        </button>
                                                        <form id="deleteform-{{$page->id}}" action="{{route('app.pages.destroy',$page->id)}}" method="POST" style="display: none;">
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
    function deletepost$page(id)
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
