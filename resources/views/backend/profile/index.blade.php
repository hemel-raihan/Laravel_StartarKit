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
                                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>Profile</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <form enctype="multipart/form-data" method="POST" action="{{route('app.profile.update')}}">
                                @csrf
                                @method('PUT')

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="main-card mb-3 card">

                                        <div class="card-body">
                                        <h5 class="card-title">Profile Photo</h5>

                                                <div class="form-group">
                                                    <label for="avatar">Avatar</label>
                                                    <input id="avatar" type="file" class=" dropify form-control @error('avatar') is-invalid @enderror" data-default-file="{{ Storage::disk('public')->url('userphoto/'.Auth::user()->image) }}" name="avatar">



                                                               @error('avatar')
                                                                   <span class="invalid-feedback" user="alert">
                                                                       <strong>{{ $message }}</strong>
                                                                   </span>
                                                               @enderror
                                                        </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="main-card mb-3 card">

                                        <div class="card-body">
                                        <h5 class="card-title">Manage Users</h5>
                                        <div class="form-group">
                                        <label for="name">User Name</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}"  autofocus>

                                                   @error('name')
                                                       <span class="invalid-feedback" user="alert">
                                                           <strong>{{ $message }}</strong>
                                                       </span>
                                                   @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}"  autofocus>

                                                           @error('email')
                                                               <span class="invalid-feedback" user="alert">
                                                                   <strong>{{ $message }}</strong>
                                                               </span>
                                                           @enderror
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">

                                                        <i class="fas fa-arrow-circle-up"></i>
                                                        Update

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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.dropify').dropify();
    $('.js-example-basic-single').select2();
});
</script>
@endpush
