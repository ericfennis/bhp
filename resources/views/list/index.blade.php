@extends('layouts.page')

@section('content')
<nav>
	<app></app>
</nav>
<main>
    <list></list>
    
</main>
<script>
    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
</script>
@endsection