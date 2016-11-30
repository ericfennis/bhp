@extends('layouts.page')

@section('content')
<nav>

</nav>
<main>
    
	<list></list>
    
</main>
<script>
    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
</script>
@endsection