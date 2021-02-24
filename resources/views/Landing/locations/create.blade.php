@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create Location') }}</div>
               

                <div class="card-body">
                   
                {{ html()->form('POST', route('location.store'))->open() }}
                <div class="form-group">
                    <label for="location_name">location Name</label>
                    <input type="text" class="form-control" id="location_name" name="location_name" placeholder="Enter location Name" required maxlength="50"  value="{{old('location_name')}}">
                </div>
                    
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                {{ html()->form()->close() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection