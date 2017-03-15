{{session()->flush()}}
Your're logout!, redirect to login page...
<script>
    setTimeout(function(){
        window.location = "{{route('login')}}";
    },2000);
</script>