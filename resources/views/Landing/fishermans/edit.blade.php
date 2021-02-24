@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit fisherman') }}
                <div class="container">
               <!-- <div class="row"> -->
               {{ $island->island_name }}
               <!-- </div> -->
               </div>
                </div>
               

                <div class="card-body">
                   
                {{ html()->form('PATCH', route('island.fisherman.update', [$island->id, $item->id]))->open() }}
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="hidden" name="island_id" value="<?php echo $island->id ?>" />
                    <input type="hidden" name="fisherman_id" value="<?php echo $item->id ?>" />
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first Name" required maxlength="50"  value="{{old('first_name', $item->first_name)}}">
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last Name" required maxlength="50"  value="{{old('last_name', $item->last_name)}}">
                </div>
                    
                <button type="submit" class="btn btn-primary mb-2">Update</button>
                {{ html()->form()->close() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection