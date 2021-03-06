@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-forms.patch action="{{ route('island.update', $item->id) }}">
                    <div class="card">
                        <div class="card-header">{{ __('Edit Island') }}
                        </div>
                        <div class="card-body">
                            <x-forms.textfield type="text" name="island_name" label="Island Name" value="{{ $item->island_name}}" />
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        </div>
                    </div>
                </x-forms.patch>
            </div>
        </div>

    </div>          
@endsection