@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create Fisherman') }}</div>
               

                <div class="card-body">
                   
                {{ html()->form('POST', route('island.fisherman.store',$item->id))->open() }}
                <div class="form-group">
                    <input type="hidden" name="island_id" value="<?php echo $item->id ?>" />
                    <label for="fisherman_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required maxlength="50"  value="{{old('first_name')}}">
                </div>
                <div class="form-group">
                    
                    <label for="fisherman_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required maxlength="50"  value="{{old('last_name')}}">
                </div>
                    
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                {{ html()->form()->close() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection