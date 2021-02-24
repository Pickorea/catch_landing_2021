@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Island') }}</div>
               

                <div class="card-body">
                   
                {{ html()->form('PATCH', route('island.update', $item->id))->open() }}
                <div class="form-group">
                    <label for="Island_name">Island Name</label>
                    <input type="text" class="form-control" id="island_name" name="island_name" placeholder="Enter Island Name" required maxlength="50"  value="{{old('island_name', $item->island_name)}}">
                </div>
                    
                <button type="submit" class="btn btn-primary mb-2">Update</button>
                {{ html()->form()->close() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection