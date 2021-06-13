@extends('layouts.backend.app')



@section('content')
                  <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>Profile Security</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <form enctype="multipart/form-data" method="POST" action="{{route('app.profile.password.update')}}">
                                @csrf
                                @method('PUT')

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="main-card mb-3 card">

                                        <div class="card-body">
                                        <h5 class="card-title">Update Password</h5>
                                        <div class="form-group">
                                        <label for="name">Old Password</label>
                                        <input id="old_password" type="password" class="form-control @error('oldpass') is-invalid @enderror" name="old_password" autofocus>

                                                   @error('oldpass')
                                                       <span class="invalid-feedback" user="alert">
                                                           <strong>{{ $message }}</strong>
                                                       </span>
                                                   @enderror
                                            </div>

                                                <div class="form-group">
                                                <label for="name">New Password</label>
                                                <input id="password" type="password" class="form-control @error('newpass') is-invalid @enderror" name="password" >

                                                           @error('newpass')
                                                               <span class="invalid-feedback" user="alert">
                                                                   <strong>{{ $message }}</strong>
                                                               </span>
                                                           @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Confirm Password</label>
                                                        <input id="password_confirmation" type="password" class="form-control @error('newpass') is-invalid @enderror" name="password_confirmation" >

                                                                   @error('newpass')
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
