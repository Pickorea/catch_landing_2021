@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <x-forms.patch action="{{ route('location.update', $item->id) }}">
                        <div class="card">
                            <div class="card-header">{{ __('Edit Locatiion') }}
                            </div>
                            <div class="card-body">
                                <x-forms.textfield type="text" name="location_name" label="Location Name" value="{{$item->location_name}}"/>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                            </div>
                        </div>
                    </x-forms.patch>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection