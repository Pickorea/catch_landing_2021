@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Species') }}</div>
               

                <div class="card-body">
                   
                {{ html()->form('PATCH', route('species.update', $item->id))->open() }}
                <div class="form-group">
                    <label for="species_name">Species Name</label>
                    <input type="text" class="form-control" id="species_name" name="species_name" placeholder="Enter species Name" required maxlength="50"  value="{{old('species_name', $item->species_name)}}">
                </div>
                    
                <button type="submit" class="btn btn-primary mb-2">Update</button>
                {{ html()->form()->close() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection