
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>AdminKit Demo - Bootstrap 5 Admin Template</title>

	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .toast-success{
            background-color: green !important;
        }
        .toast-error{
            background-color: red !important;
        }
    </style>
	@stack('styles')
</head>

<body>
	<div class="wrapper">
		@include('layouts.sidebar')
		<div class="main">
			@include('layouts.navbar')

			<main class="content">
				@yield('content')
			</main>
		</div>
	</div>

	<script src="{{ asset('js/manifest.js') }}"></script>
	<script src="{{ asset('js/vendor.js') }}"></script>
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('admin/js/app.js') }}"></script>
	<script>
		function deleteModel(deleteUrl, tableId, model = '', additional_warning = '', additionalMethod = null){
			Swal.fire({
				title: "Warning",
				text: `Destroy data ${model}? ${additional_warning}`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#169b6b',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes',
				cancelButtonText: 'No'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url : deleteUrl,
						dataType : "Json",
						data : {"_token": "{{ csrf_token() }}"},
						method : "delete",
						success:function(data){
							console.log(data)
							if(data.code == 1){
								Swal.fire(
									'Berhasil',
									data.message,
									'success'
								)
								if(additionalMethod != null){
									additionalMethod.apply(this, [data.args])
								}
								
							}else{
								Swal.fire({
									icon: 'error',
									title: 'Oops...',
									text: data.message
								})
							}
							$('#'+tableId).DataTable().ajax.reload();
						}
					})
				}
			})
		}
	</script>
	@stack('scripts')
</body>

</html>
