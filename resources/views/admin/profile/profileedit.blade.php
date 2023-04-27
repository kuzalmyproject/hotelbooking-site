@extends('admin.admin_master')
@section('admin')



<section class="content mx-auto">
      <div class="container-fluid mx-auto">
        <div class="row py-5">
          <!-- left column -->
          <div class="col-md-6 mx-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.profile.update',Auth::user()->id)}}" method="post"enctype="multipart/form-data">
              @csrf
        @method('patch')
              
              
              <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter name" value="{{Auth::user()->name}}">
                  </div>
                  @error('name')

                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="Enter Password" value="{{Auth::user()->email}}">
                  </div>

                  @error('email')

<span class="text-danger">{{ $message }}</span>
@enderror

<div class="row">

<div class="col-md-8">
<div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo">
                        <label class="custom-file-label" for="photo" id="file">Choose file</label>
                      </div>
                      
                    </div>
                  </div>
                 
</div>

@error('photo')

<span class="text-danger">{{ $message }}</span>
@enderror
<div class="col-md-4">
<img id="showImage" src="{{ (!empty(Auth::user()->photo))? asset(Auth::user()->photo):url('upload/images.png')}}" style="width: 100px; width: 100px; border: 1px solid #000000;"> 
</div>
</div>
                 
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            <!-- general form elements -->
            
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
         
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>


    <script>

document.addEventListener('DOMContentLoaded', function() {
const fileInput=document.getElementById("photo");

const fileLabel=document.getElementById("file");
const imagePreview = document.querySelector('#showImage');


fileInput.addEventListener("change",function(e){

    const file = event.target.files[0];
   const fileName=file.name;

   fileLabel.textContent=fileName;

   const reader = new FileReader();
reader.onload=function(event){

    imagePreview.src = event.target.result;

};

reader.readAsDataURL(file);

});


});

    




</script>
@endsection