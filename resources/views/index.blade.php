@if(session()->has('googleuser'))
{{session('googleuser')}}, Welcome to our website!
<a href="{{route('logout')}}">Logout</a>
@else
<script>
    window.location = "{{route('login')}}";
</script>
@endif