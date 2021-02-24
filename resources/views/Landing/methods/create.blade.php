@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create Method') }}</div>
               

                <div class="card-body">
                   
                {{ html()->form('POST', route('method.store'))->open() }}
                <div class="form-group">
                    <label for="method_name">Method Name</label>
                    <input type="text" class="form-control" id="method_name" name="method_name" placeholder="Enter method Name" required maxlength="50"  value="{{old('method_name')}}">
                </div>
                    
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                {{ html()->form()->close() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection