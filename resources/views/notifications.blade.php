@if(session()->has('success'))
    <script>
        $("body").overhang({
            type: "success",
            message: "{{session()->get('success')}}"
        });
    </script>
@endif
@if(session()->has('error'))
    <script>
        $("body").overhang({
            type: "error",
            message: "{{session()->get('error')}}",
            closeConfirm: true
        });
    </script>
@endif
@if(session()->has('info'))
    <script>
        $("body").overhang({
            type: "info",
            message: "{{session()->get('info')}}",
            duration: 3,
            upper: true
        });
    </script>
@endif
