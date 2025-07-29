@if (session()->has('success'))
    <div class="mb-8">
        <x-alert variant="success" message="{{ session('success') }}"/>
    </div>
@endif
@if ($errors->any())
    <div class="vstack items-stretch mb-8">
        @foreach($errors->all() as $error)
            <x-alert variant="error" message="{{ $error }}"/>
        @endforeach
    </div>
@endif
