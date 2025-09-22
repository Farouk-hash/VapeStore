@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
		<!-- breadcrumb -->
		<div class="breadcrumb-header justify-content-between">
			<div class="my-auto">
				<div class="d-flex">
					<h4 class="content-title mb-0 my-auto">الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الصفحه الشخصيه</span>
				</div>
			</div>
			
		</div>
		<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-lg-4">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="pl-0">
									<div class="main-profile-overview">
										<div class="main-img-user profile-user">
											<img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}"><a class="fas fa-camera profile-edit" href="JavaScript:void(0);"></a>
										</div>
										<div class="d-flex justify-content-between mg-b-20">
											<div>
												<span class=" pulse{{$user->account_active == 1 ? "" : "-danger"}}"></span>
												<h5 class="main-profile-name">{{$user->name}}</h5>
												<p class="main-profile-name-text" style='color: {{$user->account_active == 1 ? "green" : "red"}};'>
													{{$user->account_active == 0 ? 'غير مفعل':'مفعل'}}
												</p>
												
											</div>
										</div>
										<h6>Bio</h6>
										<div class="main-profile-bio">
                                            {{$user->bioData ?? 'لا يوجد ملف تعريفي'}}
                                        </div><!-- main-profile-bio -->

                                        
										@php
											$weeks = $attendances->sortKeys()->values();
											$weekKeys = $attendances->sortKeys()->keys()->values();
										@endphp

										<hr class="mg-y-30">
										<label class="main-content-label tx-13 mg-b-20"> الحضور </label>
										@if($weeks->count()!==0)
										<div id="attendance-weeks">
											@foreach ($weeks as $i => $weekAttendances)
												@php
													$weekStartDate = \Carbon\Carbon::parse($weekKeys[$i]);
													$days = collect();
													for ($d = 0; $d < 7; $d++) {
														$date = $weekStartDate->copy()->addDays($d)->toDateString();
														$attended = $weekAttendances->contains(fn($a) => $a->date == $date);
														$days->push(['date'=>$date,'attended'=>$attended]);
													}
													// mark older weeks hidden by default (all except last 4)
													$hiddenClass = $i < count($weeks)-4 ? 'hidden-week' : '';
												@endphp

												<div class="week-item {{ $hiddenClass }} skill-bar mb-4 clearfix mt-3" style="{{ $hiddenClass ? 'display:none;' : '' }}">
													<span>الأسبوع بدءًا من {{ $weekStartDate->format('d M Y') }}</span>
													<div class="progress mt-2 d-flex" style="gap:4px;">
														@foreach ($days as $day)
															<div class="progress-bar {{ $day['attended'] ? 'bg-success-gradient' : 'bg-secondary' }}" 
																style="width: calc(100% / 7)"></div>
														@endforeach
													</div>
													<div class="d-flex justify-content-between mt-1">
														@foreach ($days as $day)
															<small>{{ \Carbon\Carbon::parse($day['date'])->format('D') }}</small>
														@endforeach
													</div>
												</div>
											@endforeach
										</div>
										<button id="showMoreWeeks" class="btn btn-primary mt-3">عرض المزيد من الأسابيع</button>
													
										@else 
										<span style="color: red;">لا يوجد حضور</span>
										@endif
										</div><!-- main-profile-overview -->
													</div>
												</div>
											</div>
										</div>


						<div class="col-lg-8">
							<div class="row row-sm">
							
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											<div class="counter-icon bg-primary-transparent">
												<i class="icon-layers text-primary"></i>
											</div>
											<div class="mr-auto">
												<h5 class="tx-13">عدد الفواتير</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">{{$user->bills->count()}}</h2>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											<div class="counter-icon bg-success-transparent">
												<i class="fas fa-coins text-success"></i>
											</div>
											<div class="mr-auto">
												<h5 class="tx-13">اجمالي الارباح</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">{{number_format($billStats['total_price_sum'],2,'.',',')}}</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											<div class="counter-icon bg-warning-transparent">
												<i class="fas fa-tags text-warning"></i>
											</div>
											<div class="mr-auto">
												<h5 class="tx-13">عدد الخصومات</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">{{$billStats['discounted_bills_count']}}</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											<div class="counter-icon bg-danger-transparent">
												<i class="fas fa-percent text-danger"></i>
											</div>
											<div class="mr-auto">
												<h5 class="tx-13">اجمالي الخصومات</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">{{number_format($billStats['total_discount_value'] , 2,'.',',')}}</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											<div class="counter-icon bg-primary-transparent">
												<i class="fas fa-cash-register text-primary"></i>
											</div>
											<div class="mr-auto">
												<h5 class="tx-13">اجمالي الارباح بعد الخصومات</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">{{number_format($billStats['total_after_discount_sum'],2,'.',',')}}</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											<div class="counter-icon bg-success-transparent">
												<i class="fas fa-rocket text-success"></i>
											</div>
											<div class="mr-auto">
												<h5 class="tx-13">المنتجات المباعه</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">{{$billStats['totalProductsQuantities']}}</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="tabs-menu ">
									<!-- Tabs -->
									<ul class="nav nav-tabs profile navtab-custom panel-tabs">
										<li class="active">
											<a href="#home" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">الملف</span> </a>
										</li>

										<li class="active">
											<a href="#employeeActions" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-coins tx-16 mr-1"></i></span> <span class="hidden-xs">عمليات البيع</span> </a>
										</li>

										<li class="">
											<a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-cog tx-16 mr-1"></i></span> <span class="hidden-xs">الاعدادات</span> </a>
										</li>
									</ul>
								</div>
								<div class="tab-content border-left border-bottom border-right border-top-0 p-4">
									
									<div class="tab-pane active" id="home">
										<h4 class="tx-15 text-uppercase mb-3">ملف تعريفي</h4>
										<p class="m-b-5">
                                            {{$user->bioData ?? 'لا يوجد ملف تعريفي'}}
                                        </p>
										
										<h4 class="tx-15 text-uppercase mt-3">الخبرات</h4>
                                        <div class="m-t-30">
                                            @forelse ($user->history as $historyDetails)
                                                <div class=" p-t-10">
                                                    <h5 class="text-primary m-b-5 tx-14">{{$historyDetails->position_title}} </h5>
                                                    <p class="">{{$historyDetails->company_name}} / {{$historyDetails->website ?? 'لا يوجد موقع للمكان'}}</p>
                                                    <p><b>{{ \Carbon\Carbon::parse($historyDetails->start_date)->format('Y') }}
                                                    -{{ \Carbon\Carbon::parse($historyDetails->end_date)->format('Y') }}
                                                    </b></p>
                                                    <p class="text-muted tx-13 m-b-0">{{$historyDetails->notes}}</p>
                                                </div>
                                                <hr>
                                            @empty
                                                <div class=" p-t-10">
                                                    <span style="color: red;">لا توجد خبرات محدده</span>
                                                </div>
                                            @endforelse
											
										</div>
									</div>
									

									<div class="tab-pane active" id="employeeActions">
                                        <div class="row">
											@foreach ($user->bills as $bill )
												<div class="col-sm-4">
													<div class="border p-1 card thumb">
														<a href="{{route('bills.show',$bill->id)}}" class="image-popup" title="Screenshot-2"> 
															<h4 class="text-center tx-14 mt-3 mb-0">{{$bill->customer->name}}</h4>
															<div class="ga-border"></div>
															<p class="text-muted text-center">
																<small>اجمالي الفاتوره : {{$bill->total_price}}</small>
															</p>
															<hr>
															<p class="text-muted text-center">
																<small>اجمالي الفاتوره بعد الخصم :{{$bill->total_after_discount}}</small>
															</p>
														</a>
													</div>
												</div>
											@endforeach
											
											
										
											

											{{-- <button id="showMoreSellingActions" class="btn btn-primary mt-3">عرض المزيد من عمليات البيع</button> --}}
										</div>

									</div>
									
									<div class="tab-pane" id="settings">

										<form action="{{route('employee.update',$user->id)}}" method="POST">
                                            @method('PUT')
                                            @csrf
											<div class="form-group">
												<label for="name">الاسم</label>
												<input type="text" value="{{$user->name}}" id="name" name='name' class="form-control">
											</div>
											<div class="form-group">
												<label for="email">الايميل</label>
												<input type="email" value="{{$user->email}}" id="email" name='email' class="form-control">
											</div>
                                            <div class="form-group">
												<label for="nationalID">الرقم القومي</label>
												<input type="text" value="{{$user->nationalID}}" id="nationalID" name='nationalID' class="form-control">
											</div>
											<div class="form-group">
												<label for="phone">رقم الهاتف</label>
												<input type="string" value="{{$user->phone}}" id="phone" name='phone' class="form-control">
											</div>
											
											<div class="form-group">
												<label for="AboutMe">الملف التعريفي</label>
												<textarea id="AboutMe" class="form-control" name ='bioData'>
                                                    {{$user->bioData ?? 'لا يوجد ملف تعريفي '}}
                                                </textarea>
											</div>
											<button class="btn btn-primary waves-effect waves-light w-md" type="submit">حفظ</button>
										</form>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<script>
document.getElementById('showMoreWeeks').addEventListener('click', function() {
    const hiddenWeeks = document.querySelectorAll('.hidden-week');
    let shown = 0;

    for (let i = hiddenWeeks.length - 1; i >= 0 && shown < 4; i--) {
        hiddenWeeks[i].style.display = 'block';
        hiddenWeeks[i].classList.remove('hidden-week');
        shown++;
    }

    // hide the button if no more weeks left
    if (document.querySelectorAll('.hidden-week').length === 0) {
        this.style.display = 'none';
    }
});
</script>


@endsection