@extends('admin.admin_master')
@section('admin')

         

<div class="col-md-8 mx-auto">
            <!-- Widget: user widget style 1 -->
         <div class="py-5">
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{Auth::user()->name}}</h3>
                <h5 class="widget-user-desc">{{Auth::user()->email}}</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ (!empty(Auth::user()->photo))? asset(Auth::user()->photo):url('upload/images.png')}}" alt="User Avatar">
              </div>
              <div class="card-footer d-flex justify-content-center">
  <a href="{{route('admin.profile.edit')}}" class="btn btn-success rounded-pill mb-5">Edit Profile</a>
</div>

            <!-- /.widget-user -->
            </div>
          </div>  
               
          </div> 
@endsection