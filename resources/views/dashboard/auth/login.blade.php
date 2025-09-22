@extends('dashboard.layouts.master2')
@section('css')
@endsection
@section('content')

<div class="container-fluid">
	<div class="row no-gutter">
		<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
			<div class="row wd-100p mx-auto text-center">
				<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
					<img src="{{URL::asset('dashboard/img/media/login.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
				</div>
			</div>
		</div>

		<!-- الجزء الخاص بالفورم -->
		<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
			<div class="login d-flex align-items-center py-2">
				<div class="container p-0">
					<div class="row">
						<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
							<div class="card-sigin">
								<div class="mb-5 d-flex">
									<a href="{{ url('/' . $page='index') }}">
										<img src="{{URL::asset('dashboard/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo">
									</a>
									<h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>pp</span>ing</h1>
								</div>
								<div class="card-sigin">
									<div class="main-signup-header">
										<h2>مرحباً بعودتك</h2>
										<h5 class="font-weight-semibold mb-4">من فضلك قم بتسجيل الدخول</h5>

										@error('failed')
											<span style="color: red;">{{$message}}</span>	
										@enderror

										<div class="dropdown mb-3">
											<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												اختر نوع تسجيل الدخول
											</button>

											<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
												<button class="dropdown-item login-selector" data-type="admin" type="button">ادمن</button>
												<button class="dropdown-item login-selector" data-type="sales" type="button">موظف</button>
												<button class="dropdown-item login-selector" data-type="customer" type="button">عميل</button>
											</div>
										</div>

										<div id="login-type-heading" style="display: none; margin-top: 20px;">
											<h3 class="text-primary">تسجيل الدخول كـ <span id="selected-login-type"></span></h3>
										</div>

										<form method="POST" action="{{ route('login') }}">
											@csrf
											<input type="hidden" name="guard" id="selected-guard">

											<div class="form-group">
												<label for="email">البريد الإلكتروني</label>
												<input id="email" type="email" class="form-control" name="email" required autofocus>
											</div>

											<div class="form-group">
												<label for="password">كلمة المرور</label>
												<input id="password" type="password" class="form-control" name="password" required>
											</div>

											<button type="submit" class="btn btn-primary btn-block">تسجيل الدخول</button>
										</form>
										<div class="main-signup-footer mt-5">
											<p>ليس حساب بالفعل: <a href="{{route('register')}}">انشاء حساب</a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('js')
<script>
document.addEventListener("DOMContentLoaded", function () {
	const dropdownItems = document.querySelectorAll(".dropdown-item");
	const formDiv = document.getElementById("form");
	const loginTypeHeading = document.getElementById("login-type-heading");
	const selectedLoginTypeSpan = document.getElementById("selected-login-type");

	dropdownItems.forEach(function(item) {
		item.addEventListener("click", function() {
			const selectedGuard = item.getAttribute("data-type");
			const selectedText = item.textContent;
			console.log("Selected guard:", selectedGuard);

			// Query the hidden input more specifically
			const guardInput = document.querySelector("input[name='guard']");
			console.log(guardInput);
			if (guardInput) {
				guardInput.value = selectedGuard;
				console.log("Guard input value set to:", guardInput.value);
			} else {
				console.log("Guard input not found!");
			}

			// Update the heading with selected login type
			selectedLoginTypeSpan.textContent = selectedText;
			loginTypeHeading.style.display = "block";

			// Show the form
			formDiv.style.display = "block";
		});
	});
});
</script>
@endsection