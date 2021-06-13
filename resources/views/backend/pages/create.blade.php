@extends('layouts.backend.app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .dropify-wrapper .dropify-message p {
        font-size: initial;
    }
</style>
@endpush

@section('content')
                  <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>{{ isset($page) ? 'Edit ' : 'Create '}}pages</div>
                            </div>
                            <div class="page-title-actions">
                                <a href="{{route('app.pages.index')}}" class="btn-shadow mr-3 btn btn-danger">
                                    <i class="fa fa-arrow-circle-left"></i>
                                    Back to List
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <form enctype="multipart/form-data" method="POST" action="{{isset($page) ? route('app.pages.update',$page->id) : route('app.pages.store')}}">
                                @csrf
                                @isset($page)
                                @method('PUT')
                                @endisset
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="main-card mb-3 card">

                                        <div class="card-body">
                                        <h5 class="card-title">Basic Info</h5>
                                        <div class="form-group">
                                        <label for="title">Title</label>
                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $page->title ?? old('title') }}"  autofocus>

                                                   @error('title')
                                                       <span class="invalid-feedback" page="alert">
                                                           <strong>{{ $message }}</strong>
                                                       </span>
                                                   @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="excerpt">Excerpt</label>
                                                <textarea class="form-control @error('excerpt') is-invalid @enderror" name="excerpt"  autofocus>
                                                    {{ $page->excerpt ?? old('excerpt') }}
                                                </textarea>

                                                           @error('excerpt')
                                                               <span class="invalid-feedback" page="alert">
                                                                   <strong>{{ $message }}</strong>
                                                               </span>
                                                           @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="body">Body</label>
                                                        <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body"  autofocus>
                                                            {{ $page->body ?? old('body') }}
                                                        </textarea>

                                                                   @error('body')
                                                                       <span class="invalid-feedback" page="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror
                                                            </div>



                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="main-card mb-3 card">

                                        <div class="card-body">
                                        <h5 class="card-title">Select Image and Status</h5>

                                                <div class="form-group">
                                                    <label for="avatar">Image</label>
                                                    <input id="image" type="file" class=" dropify form-control @error('avatar') is-invalid @enderror" data-default-file="{{ $page->getFirstMediaUrl('image') }}" name="image">



                                                               @error('avatar')
                                                                   <span class="invalid-feedback" page="alert">
                                                                       <strong>{{ $message }}</strong>
                                                                   </span>
                                                               @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch">
                                                                <input class="custom-control-input" type="checkbox" @isset($page) {{$page->status == true ? 'checked' : ''}} @endisset id="status" name="status">
                                                                <label class="custom-control-label" for="status">Status</label>
                                                              </div>
                                                              @error('status')
                                                              <span class="text-danger" page="alert">
                                                                  <strong>{{ $message }}</strong>
                                                              </span>
                                                          @enderror
                                                        </div>

                                                            <button type="submit" class="btn btn-primary">
                                                            @isset($page)
                                                            <i class="fas fa-arrow-circle-up"></i>
                                                            Update
                                                            @else
                                                            <i class="fas fa-plus-circle"></i>
                                                            Create
                                                            @endisset
                                                            </button>
                                        </div>
                                    </div>

                                    <div class="main-card mb-3 card">

                                        <div class="card-body">
                                        <h5 class="card-title">Meta Info</h5>

                                        <div class="form-group">
                                            <label for="name">Meta Description</label>
                                            <textarea class="form-control @error('meta_description') is-invalid @enderror" name="meta_description"  autofocus>
                                                {{ $page->meta_description ?? old('name') }}
                                            </textarea>

                                                       @error('meta_description')
                                                           <span class="invalid-feedback" page="alert">
                                                               <strong>{{ $message }}</strong>
                                                           </span>
                                                       @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Meta Keywords</label>
                                                    <textarea class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords"  autofocus>
                                                        {{ $page->meta_keywords ?? old('name') }}
                                                    </textarea>

                                                               @error('meta_keywords')
                                                                   <span class="invalid-feedback" page="alert">
                                                                       <strong>{{ $message }}</strong>
                                                                   </span>
                                                               @enderror
                                                        </div>
                                         </div>
                                    </div>

                                </div>
                            </div>
                    </form>
                </div>
            </div>
@endsection

@push('js')
<script src="https://cdn.tiny.cloud/1/mtvzwucy0u4uswb7sa7uxihohnn95bm7822myrnlrzee8mh6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    tinymce.init({
      selector: '#body',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
   });
  // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.dropify').dropify();

});
</script>
@endpush
