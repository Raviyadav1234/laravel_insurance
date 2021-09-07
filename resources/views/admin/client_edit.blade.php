@extends('layouts.admin')

@section('title','Client Edit')

@section('content')

<div class="col-lg-6 col-sm-12 mt-5">
    <!-- Page Heading -->
                   {{-- @if(session()->has('success'))
                    <div class="alert alert-success" id="success">
                    {{session('success')}}
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
               
    @foreach ($item as $value) 
             
    <form method="POST" id="myform" action="{{ route('client.update') }}">
      @csrf
      @method('PUT')
     
       <div class="form-group">
        <input type="hidden" name="client_id" id="id" value="{{$value->id}}" class="form-control">
            <label for="client_name">Client Name</label>
            <input type="text" name="client_name" class="form-control" id="client_name" value="{{$value->client_name}}"  required >
                @error('client_name')
                <span class="text-danger">{{$message}}</span>
                @enderror
        </div>
        <div class="form-group">
            <label for="client_email">Email</label>
            <input type="email" name="client_email" class="form-control" id="client_email" value="{{$value->client_email}}" required>
                @error('client_email')
                <span class="text-danger">{{$message}}</span>
                @enderror
        </div>
        <div class="form-group">
            <label for="client_mobile">Mobile Number</label>
            <input type="text" name="client_mobile" class="form-control" id="client_mobile" value="{{$value->client_mobile}}" required>
                @error('client_mobile')
                <span class="text-danger">{{$message}}</span>
                @enderror
        </div>

  
        <button type="submit" class="btn btn-primary mb-2" name="submit_btn" id="update">Update</button>
      
      </form>
      @endforeach
    </div>

@endsection

@push('script')
    <script>
        $('#myform').submit(function(e){
         e.preventDefault();
         $.ajax({
             url:"{{route('client.update')}}",
             data:$('#myform').serialize(),
             type:'post',
             success:function(result){
                 $('#success').html(result.success);
                 $('#success').removeClass('d-none');
                
             }
         });
        });
        </script>
@endpush


