@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create Species') }}</div>
               

                <div class="card-body">
                   
                {{ html()->form('POST', route('species.store'))->open() }}
                <div class="form-group">
                    <label for="species_name">Species Name</label>
                    <input type="text" class="form-control" id="species_name" name="species_name" placeholder="Enter Species Name" required maxlength="50"  value="{{old('species_name')}}">
                </div>
                    
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                {{ html()->form()->close() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection