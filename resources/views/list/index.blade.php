@extends('layouts.page')

@section('content')
<script>
    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
</script>
<main id="app">
</main>

@endsection