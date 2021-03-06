@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card">
                <x-forms.post action="{{ route('fisherman.store')}}">
                <input type="hidden" name="island_id" value="{{$item->island_id}}" />
                    <div class="card">
                        <div class="card-header">{{ __('Create Fisherman') }}
                        </div>
                        <div class="card-body">
                            @isset($item->island)
                            <p>Island : {{ $item->island->island_name }}</p>
                            @endisset
                            <x-forms.textfield type="text" name="first_name" label="First Name" value="{{ $item->first_name }}" required />
                            <x-forms.textfield type="text" name="last_name" label="Last Name" value="{{ $item->last_name }}" required />
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        </div>
                    </div>
                </x-forms.post>
            </div>
    </div>
</div>
@endsection
