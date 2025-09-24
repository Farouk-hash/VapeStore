@extends('dashboard.layouts.master2')
@section('css')
<style>
#login-image {
    transition: opacity 0.6s ease-in-out;
}
#login-image.loaded {
    opacity: 1 !important;
}
#image-loader.fade-out {
    opacity: 0;
    transition: opacity 0.4s ease-in-out;
    pointer-events: none;
}
</style>
@endsection

@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">

				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex p-0 position-relative">
			<!-- Loader -->
			<div id="image-loader" class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center bg-light">
				<div class="spinner-border text-primary" role="status">
					<span class="sr-only">Loading...</span>
				</div>
			</div>

			<!-- Image -->
			<img src="{{ URL::asset('dashboard/img/media/login.jpg') }}" 
				class="w-100 h-100 object-fit-cover opacity-0" 
				id="login-image"
				alt="logo">
		</div>
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
								<div class="mb-5 d-flex"> <a href="{{ url('/' . $page='index') }}">

									<img src="{{URL::asset('dashboard/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo"></a><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>pp</span>ing</h1></div>
									<div class="main-card-signin d-md-flex bg-white">
										<div class="wd-100p">
											<div class="main-signin-header">
												<h5>هل نسيت كلمة مرورك؟ لا مشكلة. ما عليك سوى تزويدنا بعنوان بريدك الإلكتروني وسنرسل إليك رابط إعادة تعيين كلمة المرور لاختيار كلمة مرور جديدة.!</h5>


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

												<form action="{{route('password.email')}}" method="POST">
													@csrf
													<input type="hidden" name="guard" id="selected-guard">



													{{-- Success message --}}
													@if (session('status'))
														<div class="alert alert-success">
															{{ session('status') }}
														</div>
													@endif

													{{-- Validation errors --}}
													@if ($errors->any())
														<div class="alert alert-danger">
															<ul class="mb-0">
																@foreach ($errors->all() as $error)
																	<li>{{ $error }}</li>
																@endforeach
															</ul>
														</div>
													@endif

													<div class="form-group">
														<label>الايميل</label> <input class="form-control" placeholder="من فضلك قم بكتابه الايميل" name="email" type="text">
													</div>
													<button class="btn btn-main-primary btn-block">ارسال</button>
												</form>

											</div>
											<div class="main-signup-footer mg-t-20">
												<p>انس الأمر، <a href="{{route('login')}}">أعدني</a> إلى شاشة تسجيل الدخول.</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->
			</div>
		</div>
@endsection
@section('js')
<script>
document.addEventListener("DOMContentLoaded", function () {
		
    const img = document.getElementById("login-image");
    const loader = document.getElementById("image-loader");

    img.onload = function () {
        img.classList.add("loaded");
        loader.classList.add("fade-out");
        setTimeout(() => loader.style.display = "none", 400); // remove after fade
    };

    // If already cached
    if (img.complete) {
        img.onload();
    }
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const dropdownItems = document.querySelectorAll(".dropdown-item");
    const dropdownButton = document.getElementById("dropdownMenu2");
    const loginTypeHeading = document.getElementById("login-type-heading");
    const selectedLoginTypeSpan = document.getElementById("selected-login-type");
    const guardInput = document.getElementById("selected-guard"); // Use ID instead of name

    dropdownItems.forEach(function(item) {
        item.addEventListener("click", function() {
            const selectedGuard = item.getAttribute("data-type");
            const selectedText = item.textContent.trim();
            
            console.log("Selected guard:", selectedGuard);

            // Update dropdown button text
            dropdownButton.textContent = selectedText;

            // Set guard value
            if (guardInput) {
                guardInput.value = selectedGuard;
                console.log("Guard input value set to:", guardInput.value);
            } else {
                console.error("Guard input not found!");
            }

            // Update the heading with selected login type
            selectedLoginTypeSpan.textContent = selectedText;
            loginTypeHeading.style.display = "block";
        });
    });

    // Form validation before submit
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        if (!guardInput.value) {
            e.preventDefault();
            alert('يرجى اختيار نوع تسجيل الدخول أولاً');
        }
    });
});
</script>
@endsection