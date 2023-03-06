@if ($message = Session::get('success'))
    <script>
        $( document ).ready(function(){
			swal({
				title: "Successful!",
				text: "{{ $message }}",
				type: "success",
				confirmButtonClass: "btn-success btn",
			});
        });
    </script>
@endif

@if ($message = Session::get('error'))
    <script>
        $( document ).ready(function(){
			swal({
				title: "Error!",
				text: "{{ $message }}",
				type: "error",
				confirmButtonClass: "btn-danger btn",
			});
        });
    </script>
@endif

@if ($message = Session::get('warning'))
    <script>
        $( document ).ready(function(){
            swal({
				title: "Warning!",
				text: "{{ $message }}",
				type: "warining",
				confirmButtonClass: "btn-warning btn",
			});
        });
    </script>
@endif

@if ($message = Session::get('info'))
    <script>
        $( document ).ready(function(){
            swal({
				title: "Thông báo!",
				text: "{{ $message }}",
				type: "info",
				confirmButtonClass: "btn-info btn",
			});
        });
    </script>
@endif