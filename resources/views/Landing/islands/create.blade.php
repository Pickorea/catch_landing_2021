@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-forms.post action="{{ route('island.store') }}">
                    <div class="card">
                        <div class="card-header">{{ __('Create Island') }}
                        </div>
                        <div class="card-body">
                            <x-forms.textfield type="text" name="island_name" label="Island Name" required />
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

