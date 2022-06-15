@if ($message = Session::get('success'))
    <div class="alert p-3 alert-success alert-block">
        <strong> {{ $message }}</strong>
    </div>
    <script>
        window.localStorage.clear();
    </script>
@endif

@if ($message = Session::get('error') )
    <div class="alert p-3 alert-danger alert-block">

        <strong> {{$message}}</strong>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert p-3 alert-warning alert-block">
    <strong> {{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
    <div class="alert p-3 alert-info alert-block">
    <strong> {{ $message }}</strong>
    </div>
@endif

@push('scripts')
    <script>
        $(".alert-block").fadeTo(5000, 500).slideUp(500);
    </script>
@endpush

@if ($errors->any())
<div class="alert p-3 alert-danger">
    <ul class="m-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif