@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <x-forms.patch action="{{ route('island.fisherman.update', [$island->id, $item->id]) }}">
                <input type="hidden" name="island_id" value="{{$item->id}}" />
                    <div class="card">
                        <div class="card-header">{{ __('Edit Fisherman') }}
                        </div>
                        <div class="card-body">
                        <x-forms.textfield type="text" name="first_name" label="First Name" required />
                        <x-forms.textfield type="text" name="last_name" label="Last Name" required />
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