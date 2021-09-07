@extends('layouts.admin')

@section('title','Client Register')

@section('content')

<div class="col-lg-6 col-sm-12 mt-5">
    <!-- Page Heading -->
                   {{-- @if(session()->has('success'))
                    <div class="alert alert-success" id="success">
                    
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                     </div>
                      @endif --}}
                      <div class="alert alert-success d-none" id="success">
                    
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                         </div>
                     
                      
    <form method="POST" id="myform" action="{{ route('client.save') }}">
      @csrf
       <div class="form-group">
            <label for="client_name">Client Name</label>
            <input type="text" name="client_name" class="form-control" id="client_name" value="{{old('client_name')}}"  required >
                @error('client_name')
                <span class="text-danger">{{$message}}</span>
                @enderror
        </div>
        <div class="form-group">
            <label for="client_email">Email</label>
            <input type="email" name="client_email" class="form-control" id="client_email" value="{{old('client_email')}}" required>
                @error('client_email')
                <span class="text-danger">{{$message}}</span>
                @enderror
        </div>
        <div class="form-group">
            <label for="client_mobile">Mobile Number</label>
            <input type="text" name="client_mobile" class="form-control" id="client_mobile" value="{{old('client_mobile')}}" required>
                @error('client_mobile')
                <span class="text-danger">{{$message}}</span>
                @enderror
        </div>

  
        <button type="submit" class="btn btn-primary mb-2" name="submit_btn" id="submit">Submit</button>
      
      </form>
    </div>

@endsection

@push('script')
    <script>
        $('#myform').submit(function(e){
         e.preventDefault();
         $('#submit').attr('disabled',true);
         $.ajax({
             url:"{{route('client.save')}}",
             data:$('#myform').serialize(),
             type:'post',
             success:function(result){
                 $('#success').html(result.success);
                 $('#success').removeClass('d-none');
                 $('#myform')['0'].reset();
                 $('#submit').attr('disabled',false);
             }
         });
        });
        </script>
@endpush


