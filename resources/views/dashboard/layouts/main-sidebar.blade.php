<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('dashboard/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('dashboard/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('dashboard/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('dashboard/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							
							<img src="{{ \App\Helpers\ImageHelper::getUserImageUrlWithFallback() }}" class="avatar avatar-xl brround"  alt="Profile">

							<span class="avatar-status profile-status bg-green"></span>
							
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{Auth::user()->name}}</h4>
							<span class="mb-0 text-muted">{{Auth::user()->email}}</span>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="side-item side-item-category">Main</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='index') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">Index</span><span class="badge badge-success side-badge">1</span></a>
					</li>
					<li class="side-item side-item-category">General</li>
					

					{{-- Liquids  --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							
															
								<i class="fas fa-tint"></i><span class="side-menu__label" style="padding:8px;">اللكويد</span>	


							</a>
						<ul class="slide-menu">
						<li><a class="slide-item" href="{{ route('brands.index') }}">الماركات</a></li>
						
						<li><a class="slide-item" href="{{ route('categories.index') }}">الفئات</a></li>
						<li><a class="slide-item" href="{{ route('components.index') }}">المكونات</a></li>
						<li><a class="slide-item" href="{{ route('flavours.index') }}">النكهات</a></li>
						
						<li><a class="slide-item" href="{{ route('livewire.liquids') }}">الماركات</a></li>
							{{-- <li><a class="slide-item" href="{{ route('liquid.index') }}">Liquids</a></li> --}}

						</ul>
					</li>
					
					{{-- Devices : Pod-Systems , Kits , Disposables , ... --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
								
								<i class="fas fa-tools"></i><span class="side-menu__label" style="padding:8px;">الاجهزه</span>
							</a>
						<ul class="slide-menu">
							<?php 
								$deviceCategories = App\Models\Hardware\DevicesCategories::where('hardware',true)
								->withCount('devices')
								->get();	
							?>
							@foreach ($deviceCategories as $deviceCategory)
								<li><a class="slide-item" href="{{ route('devicesCategories.index' , [$deviceCategory->slug]) }}">
									<span class="count-minimal">{{$deviceCategory->devices_count}}</span>{{$deviceCategory->name}}</a></li>
							@endforeach
						
						</ul>
					</li>

					{{-- Atomizers : tanks , coils , .... --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
								<i class="fas fa-smog"></i><span class="side-menu__label" style="padding:8px;">المعدات</span>
							</a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('tanks.index') }}"><span class="count-minimal">{{\App\Models\Tanks\Tanks::count()}}</span>Tanks</a></li>
							<li><a class="slide-item" href="{{ route('coils.index') }}"><span class="count-minimal">{{\App\Models\Coils\Coils::count()}}</span>Coils</a></li>
							<li><a class="slide-item" href="{{ route('cartridges.index') }}"><span class="count-minimal">{{\App\Models\Cartidges\Cartidge::count()}}</span>Cartridges</a></li>
							<li><a class="slide-item" href="{{ route('tanks.index') }}">Accessories</a></li>

						</ul>
					</li>

					
					{{-- Sales : New-Sale , Reports  --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
								<i class="fas fa-box"></i><span class="side-menu__label" style="padding:8px;">الاداره</span>
							</a>
						<ul class="slide-menu">							
							<li><a class="slide-item" href="{{ route('livewire.employee') }}">الموظفين</a></li>
							<li><a class="slide-item" href="{{ route('livewire.customers') }}">العملاء</a></li>

							{{-- <li><a class="slide-item" href="{{ route('employee.index') }}">الموظفين</a></li> --}}
							{{-- <li><a class="slide-item" href="{{ route('customers.index') }}">العملاء</a></li> --}}

							
							<li><a class="slide-item" href="{{ route('bills.index') }}">الفواتير</a></li>

							<li><a class="slide-item" href="{{ route('livewire.group-inventories') }}">العروض</a></li>
							<li><a class="slide-item" href="{{ route('livewire.liquid-selector') }}">عمليات البيع</a></li>
							<li><a class="slide-item" href="{{route('livewire.reports')}}">التقارير</a></li>	
						</ul>
					</li>
					
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
