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
                                <div>
                                    @isset($menuItem)
                                    Edit Menu Item
                                    @else
                                    Add New Menu Item to (<code>{{$menu->name}}</code>)
                                    @endisset
                                 </div>
                            </div>
                            <div class="page-title-actions">
                                <a href="{{route('app.menus.builder',$menu->id)}}" class="btn-shadow mr-3 btn btn-danger">
                                    <i class="fa fa-arrow-circle-left"></i>
                                    Back to List
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <form enctype="multipart/form-data" method="POST" action="{{isset($menuItem) ? route('app.menus.item.update',['id' => $menu->id, 'itemId' => $menuItem->id]) : route('app.menus.item.store',$menu->id)}}">
                                @csrf
                                @isset($menuItem)
                                @method('PUT')
                                @endisset
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="main-card mb-3 card">

                                        <div class="card-body">
                                        <h5 class="card-title">Manage Menu Item</h5>

                                        <div class="form-group">
                                            <label for="type">Type</label>
                                            <select class="custom-select" onchange="setItemType()" name="type" id="type">
                                                <option value="item" @isset($menuItem) {{$menuItem->type == 'item' ? 'selected' : ''}} @endisset >Menu Item</option>
                                                <option value="divider" @isset($menuItem) {{$menuItem->type == 'divider' ? 'selected' : ''}} @endisset >Divider</option>
                                            </select>
                                        </div>

                                        <div id="divider_fields">

                                            <div class="form-group">
                                                <label for="divider_title">Title Of the Divider</label>
                                                <input id="divider_title" type="text" class="form-control @error('divider_title') is-invalid @enderror" name="divider_title" value="{{ $menuItem->divider_title ?? old('divider_title') }}"  autofocus>

                                                           @error('divider_title')
                                                               <span class="invalid-feedback" page="alert">
                                                                   <strong>{{ $message }}</strong>
                                                               </span>
                                                           @enderror
                                                    </div>


                                        </div>


                                        <div id="item_fields">

                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $menuItem->title ?? old('title') }}"  autofocus>

                                                           @error('title')
                                                               <span class="invalid-feedback" page="alert">
                                                                   <strong>{{ $message }}</strong>
                                                               </span>
                                                           @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="url">Url for the menu item</label>
                                                        <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ $menuItem->url ?? old('url') }}"  autofocus>

                                                                   @error('url')
                                                                       <span class="invalid-feedback" page="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="target">Open In</label>
                                                                <select @error('target') is-invalid @enderror class="custom-select" name="target" id="target">
                                                                    <option value="_self" @isset($menuItem) {{$menuItem->target == '_self' ? 'selected' : ''}} @endisset >Same Tab/Window</option>
                                                                    <option value="_blank" @isset($menuItem) {{$menuItem->target == '_blank' ? 'selected' : ''}} @endisset>New Tab/Window</option>
                                                                </select>
                                                                @error('target')
                                                                       <span class="invalid-feedback" page="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="icon_class">Font Icon class for menu item <a target="_blank" href="https://fontawesome.com/">Use a Font awesome Font class</a></label>
                                                                <input id="icon_class" type="text" class="form-control @error('icon_class') is-invalid @enderror" name="icon_class" value="{{ $menuItem->icon_class ?? old('icon_class') }}"  autofocus>

                                                                           @error('icon_class')
                                                                               <span class="invalid-feedback" page="alert">
                                                                                   <strong>{{ $message }}</strong>
                                                                               </span>
                                                                           @enderror
                                                                    </div>
                                                          </div>


                                                    <button type="submit" class="btn btn-primary">
                                                        @isset($menuItem)
                                                        <i class="fas fa-arrow-circle-up"></i>
                                                        Update
                                                        @else
                                                        <i class="fas fa-plus-circle"></i>
                                                        Create
                                                        @endisset
                                                        </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
@endsection

@push('js')
<script>
    function setItemType()
    {
        if($('select[name="type"]').val() === 'divider')
        {
            $('#divider_fields').removeClass('d-none');  // d-none => display none
            $('#item_fields').addClass('d-none');         // d-none => display add
        }
        else
        {
            $('#divider_fields').addClass('d-none');  // d-none => display none
            $('#item_fields').removeClass('d-none');
        }
    }
    setItemType();
</script>
@endpush
