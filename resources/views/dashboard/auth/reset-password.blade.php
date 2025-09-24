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

				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">

						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="mb-5 d-flex"> 
										<a href="{{ url('/' . $page='index') }}">
											<img src="{{URL::asset('dashboard/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo">
										</a>
										<h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>pp</span>ing</h1>
									</div>
									<div class="main-card-signin d-md-flex">
										<div class="wd-100p">
											<div class="main-signin-header">
												<div class="">
													<h2>مرحباً بعودتك!</h2>
													<h4 class="text-left">إعادة تعيين كلمة المرور</h4>
													<form method="POST" action="{{ route('password.store') }}">
													
													@csrf 
													<input type="hidden" name="token" value="{{ $request->route('token') }}">
													<input type="hidden" name="guard" value="{{ $request->get('guard') }}">

													<div class="form-group text-left">
														<label>البريد الإلكتروني</label>
														<input class="form-control" name="email"
															value="{{ old('email', $request->get('email')) }}"
															placeholder="أدخل بريدك الإلكتروني" type="text">
														@error('email')
															<span class="text-danger small">{{ $message }}</span>
														@enderror
													</div>

													<div class="form-group text-left">
														<label>كلمة المرور الجديدة</label>
														<input class="form-control" name="password"
															placeholder="أدخل كلمة المرور الجديدة" type="password">
														@error('password')
															<span class="text-danger small">{{ $message }}</span>
														@enderror
													</div>

													<div class="form-group text-left">
														<label>تأكيد كلمة المرور</label>
														<input class="form-control" name="password_confirmation"
															placeholder="أعد إدخال كلمة المرور" type="password">
														@error('password_confirmation')
															<span class="text-danger small">{{ $message }}</span>
														@enderror
													</div>

													<button class="btn ripple btn-main-primary btn-block">إعادة تعيين كلمة المرور</button>
												</form>

												</div>
											</div>
											<div class="main-signup-footer mg-t-20">
												<p>لديك حساب بالفعل؟ <a href="{{route('login') }}">تسجيل الدخول</a></p>
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
@endsection
