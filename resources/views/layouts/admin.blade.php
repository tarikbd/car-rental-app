<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
	<style>			.navbar{background:lightblue!important}h1{font-size:40px!important}.nav-link{color:black!important}.nav-link:hover{color:#ff3366!important}a.navbar-brand:hover{color:#ff3366!important}
	</style>
</head>
<body>

<!-- Admin Sidebar -->
<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light p-32 w-100 bg-light">
			<div class="container">
				<a class="navbar-brand" href="#"><h1>Car Rent App</h1></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item">
							<a class="nav-link" href="{{ route('admin.index') }}">Dashboard</a>
						</li>  
						<li class="nav-item">
							<a class="nav-link" href="{{ route('admin.info') }}">Info Page</a>
						</li>	
						
						<li class="nav-item">
							<a class="nav-link" href="{{ route('admin.cars.index') }}">Manage Cars</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('admin.customers.index') }}">Manage Customers</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('logout') }}">Logout</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>	
        <!-- Main Content Area -->
        <main role="main" class="col-sm-8 col-md-10" style="margin:30px auto">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
