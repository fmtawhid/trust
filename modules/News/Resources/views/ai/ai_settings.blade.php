@extends('backend.layouts.app')
@section('title', 'AI Settings')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">AI Writer Settings</h5>
    </div>
    <div class="card-body">
        @include('backend.layouts.common.message')
        <form method="POST" action="{{ route('ai.settings.update') }}">
            @csrf
                @method('PATCH')

            <div class="mb-3">
                <label>API Key</label>
                <input type="text" name="api_key" class="form-control" value="{{ old('api_key', $settings->api_key) }}">
            </div>

            <div class="form-group mb-3">
                <label for="model" class="form-label">Model</label>
                <select class="form-control" id="model" name="model" required>
                    <option value="gpt-3.5-turbo" {{ $settings?->model == 'gpt-3.5-turbo' ? 'selected' : '' }}>gpt-3.5-turbo</option>
                    <option value="gpt-4" {{ $settings?->model == 'gpt-4' ? 'selected' : '' }}>gpt-4</option>
                    <option value="gpt-4o" {{ $settings?->model == 'gpt-4o' ? 'selected' : '' }}>gpt-4o</option>
                </select>
            </div>


            <div class="mb-3">
                <label>Temperature</label>
                <input type="number" step="0.1" name="temperature" class="form-control" value="{{ old('temperature', $settings->temperature) }}">
            </div>

            <div class="mb-3">
                <label>Max Tokens</label>
                <input type="number" name="max_tokens" class="form-control" value="{{ old('max_tokens', $settings->max_tokens) }}">
            </div>

            <div class="mb-3">
                <label>Prompt Template</label>
                <textarea name="prompt_template" class="form-control" rows="4">{{ old('prompt_template', $settings->prompt_template) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Save Settings</button>
        </form>
    </div>
</div>
@endsection