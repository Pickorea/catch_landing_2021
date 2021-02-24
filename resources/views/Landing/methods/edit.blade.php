@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Method') }}</div>
               

                <div class="card-body">
                   
                {{ html()->form('PATCH', route('method.update', $item->id))->open() }}
                <div class="form-group">
                    <label for="method_name">method Name</label>
                    <input type="text" class="form-control" id="method_name" name="method_name" placeholder="Enter method Name" required maxlength="50"  value="{{old('method_name', $item->method_name)}}">
                </div>
                    
                <button type="submit" class="btn btn-primary mb-2">Update</button>
                {{ html()->form()->close() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection