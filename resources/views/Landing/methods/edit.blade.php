@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <x-forms.patch action="{{ route('method.update', $item->id) }}">
                    <div class="card">
                        <div class="card-header">{{ __('Edit Method') }}
                        </div>
                        <div class="card-body">
                            <x-forms.textfield type="text" name="method_name" label="Method Name" value="{{ $item->method_name}}" />
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mb-2">Update</button>
                        </div>
                    </div>
                </x-forms.patch>
        </div>
    </div>
</div>
@endsection