@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card">
                <x-forms.post action="{{ route('fisherman.store')}}">
                    <div class="card">
                        <div class="card-header">{{ __('Create Fisherman') }}
                        </div>
                        <div class="card-body">
                            <x-forms.select-from-pluck name="island_id" label="Island" :options="$islands" value="{{ old('island_id', $item->island_id) }}" required />
                            <x-forms.textfield type="text" name="first_name" label="First Name" value="{{ old('first_name',$item->first_name) }}" required />
                            <x-forms.textfield type="text" name="last_name" label="Last Name" value="{{ old('last_name',$item->last_name) }}" required />
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
