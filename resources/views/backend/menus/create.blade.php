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
                                <div>{{ isset($menu) ? 'Edit ' : 'Create '}}Menus</div>
                            </div>
                            <div class="page-title-actions">
                                <a href="{{route('app.menus.index')}}" class="btn-shadow mr-3 btn btn-danger">
                                    <i class="fa fa-arrow-circle-left"></i>
                                    Back to List
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <form enctype="multipart/form-data" method="POST" action="{{isset($menu) ? route('app.menus.update',$menu->id) : route('app.menus.store')}}">
                                @csrf
                                @isset($menu)
                                @method('PUT')
                                @endisset
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="main-card mb-3 card">

                                        <div class="card-body">
                                        <h5 class="card-title">Basic Info</h5>
                                        <div class="form-group">
                                        <label for="name">Name</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $menu->name ?? old('title') }}"  autofocus>

                                                   @error('name')
                                                       <span class="invalid-feedback" page="alert">
                                                           <strong>{{ $message }}</strong>
                                                       </span>
                                                   @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control @error('excerpt') is-invalid @enderror" name="description"  autofocus>
                                                    {{ $menu->description ?? old('description') }}
                                                </textarea>

                                                           @error('description')
                                                               <span class="invalid-feedback" page="alert">
                                                                   <strong>{{ $message }}</strong>
                                                               </span>
                                                           @enderror
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">
                                                        @isset($menu)
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
<script >
</script>
@endpush
