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
                                <div>Menu Builder ({{$menu->name}})</div>
                            </div>
                            <div class="page-title-actions">
                                <a href="{{route('app.menus.index')}}" class="btn-shadow mr-3 btn btn-danger">
                                    <i class="fa fa-arrow-circle-left"></i>
                                    Back to List
                                </a>

                                <a href="{{route('app.menus.item.create',$menu->id)}}" class="btn-shadow mr-3 btn btn-primary">
                                    <i class="fas fa-plus-circle"></i>
                                    Create Menu Item
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <h5 class="card-title">How To Use</h5>
                                    <p>You can output a menu anywhere on your site bu calling <code>menu('name')</code></p>
                                </div>
                            </div>

                            <div class="main-card mb-3 card">
                                <div class="card-body menu-builder">
                                    <h5 class="card-title">Drag and drop the menu Items below to re-arrange them.</h5>
                                    <div class="dd">
                                        <ol class="dd-list">
                                            @forelse($menu->menuItems as $item)
                                            <li class="dd-item" data-id="{{$item->id}}">

                                                <div class="pull-right item_actions">
                                                    @if($auth->hasPermission('app.menus.edit'))
                                               <a href="{{route('app.menus.item.edit',['id'=>$menu->id, 'itemId'=>$item->id])}}" class="btn btn-info btn-sm">
                                                   <i class="fas fa-edit"></i>
                                                   <span>Edit</span>
                                                </a>
                                                @endif

                                               @if($auth->hasPermission('app.menus.destroy'))
                                               <button class="btn btn-danger btn-sm" type="button"
                                                   onclick="deleteData({{ $item->id}})" >
                                                   <i class="fas fa-trash-alt"></i>
                                                   <span>Delete</span>
                                                   </button>
                                                   <form id="deleteform-{{$item->id}}" action="{{route('app.menus.item.destroy',['id'=>$menu->id, 'itemId'=>$item->id])}}" method="POST" style="display: none;">
                                                   @csrf
                                                   @method('DELETE')
                                                   </form>

                                                   @endif
                                                </div>

                                                <div class="dd-handle">
                                                    @if($item->type == 'divider')
                                                    <strong> Divider: {{$item->divider_title }}</strong>
                                                    @else
                                                    <span> {{$item->title }}</span>
                                                    <small class="url">{{$item->url}}</small>
                                                    @endif
                                                </div>

                                                @if(!$item->childs->isEmpty())
                                                <ol class="dd-list">
                                                    @foreach($item->childs as $childItem)
                                                    <li class="dd-item" data-id="{{$childItem->id}}">

                                                        <div class="pull-right item_actions">
                                                            @if($auth->hasPermission('app.menus.edit'))
                                                       <a href="{{route('app.menus.item.edit',['id'=>$menu->id, 'itemId'=>$childItem->id])}}" class="btn btn-info btn-sm">
                                                           <i class="fas fa-edit"></i>
                                                           <span>Edit</span>
                                                        </a>
                                                        @endif

                                                       @if($auth->hasPermission('app.menus.destroy'))
                                                       <button class="btn btn-danger btn-sm" type="button"
                                                           onclick="deleteData({{ $childItem->id}})" >
                                                           <i class="fas fa-trash-alt"></i>
                                                           <span>Delete</span>
                                                           </button>
                                                           <form id="deleteform-{{$childItem->id}}" action="{{route('app.menus.item.destroy',['id'=>$menu->id, 'itemId'=>$childItem->id])}}" method="POST" style="display: none;">
                                                           @csrf
                                                           @method('DELETE')
                                                           </form>

                                                           @endif
                                                        </div>

                                                        <div class="dd-handle">
                                                            @if($childItem->type == 'divider')
                                                            <strong> Divider: {{$childItem->divider_title }}</strong>
                                                            @else
                                                            <span> {{$childItem->title }}</span>
                                                            <small class="url">{{$childItem->url}}</small>
                                                            @endif
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ol>
                                                @endif

                                            </li>
                                            @empty
                                            <div class="text-center">
                                                <strong>No menu item found.</strong>
                                            </div>
                                            @endforelse
                                            <li></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
@endsection

@push('js')
<script >
    $('.dd').nestable({maxDepth:2});
    $('.dd').on('change',function(e)
    {
console.log(JSON.stringify($('.dd').nestable('serialize')));
        $.post("{{route('app.menus.order',$menu->id)}}",{
            order:JSON.stringify($('.dd').nestable('serialize')),
            _token: '{{csrf_token()}}'
        },function(data){
            iziToast.success({
                title: 'Success',
                message: 'Successfully updatd menu order',
            });
        })
    })
</script>
@endpush

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function deleteData(id)
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


