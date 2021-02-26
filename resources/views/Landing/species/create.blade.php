@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <x-forms.post action="{{ route('species.store') }}">
                    <div class="card">
                        <div class="card-header">{{ __('Create Species') }}
                        </div>
                        <div class="card-body">
                            <x-forms.textfield type="text" name="species_name" label="Species Name" required/>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        </div>
                    </div>
                </x-forms.post>          
            </div>
        </div>
    </div>
</div>
@endsection