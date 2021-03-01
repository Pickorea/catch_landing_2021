@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <x-forms.patch action="{{ route('species.update', $item->id) }}">
                    <div class="card">
                        <div class="card-header">{{ __('Edit Species') }}
                        </div>
                        <div class="card-body">
                            <x-forms.textfield type="text" name="species_name" label="Species Name" value="{{$item->species_name}}"/>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mb-2">Update</button>
                        </div>
                    </div>
                </x-forms.patch>                   
            </div>
        </div>
    </div>
</div>
@endsection