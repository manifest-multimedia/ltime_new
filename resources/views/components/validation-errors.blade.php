@if ($errors->any())
    <div {{ $attributes }}>
        <div class="mt-3 font-medium text-red-600 alet alert-info" style="padding:15px">{{ __('Whoops! Something went wrong.') }}</div>

        <div class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        </div>
    </div>
@endif
