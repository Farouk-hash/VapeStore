
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
                                        <h5 class="main-profile-name">{{$customer->name}}</h5>
                                        <p class="main-profile-name-text">{{$customer->phone}}</p>
                                    </div>
                                </div>
                            
                                <hr class="mg-y-30">
                                <h6>Skills</h6>
                                <div class="skill-bar mb-4 clearfix mt-3">
                                    <span>HTML5 / CSS3</span>
                                    <div class="progress mt-2">
                                        <div class="progress-bar bg-primary-gradient" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%"></div>
                                    </div>
                                </div>
                                <!--skill bar-->
                                <div class="skill-bar mb-4 clearfix">
                                    <span>Javascript</span>
                                    <div class="progress mt-2">
                                        <div class="progress-bar bg-danger-gradient" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 89%"></div>
                                    </div>
                                </div>
                                <!--skill bar-->
                                <div class="skill-bar mb-4 clearfix">
                                    <span>Bootstrap</span>
                                    <div class="progress mt-2">
                                        <div class="progress-bar bg-success-gradient" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 80%"></div>
                                    </div>
                                </div>
                                <!--skill bar-->
                                <div class="skill-bar clearfix">
                                    <span>Coffee</span>
                                    <div class="progress mt-2">
                                        <div class="progress-bar bg-info-gradient" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
                                    </div>
                                </div>
                                <!--skill bar-->
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
                                        <h2 class="mb-0 tx-22 mb-1 mt-1">{{$customer->billsDetails['bills_count']}}</h2>
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
                                        <h5 class="tx-13">اجمالي المدفوعات</h5>
                                        <h2 class="mb-0 tx-22 mb-1 mt-1">{{$customer->billsDetails['total_price']}}</h2>
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
                                        <h2 class="mb-0 tx-22 mb-1 mt-1">{{$customer->billsDetails['total_discounts']}}</h2>
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
                                        <h2 class="mb-0 tx-22 mb-1 mt-1">{{$customer->billsDetails['discount_value']}}</h2>
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
                                        <h5 class="tx-13">اجمالي المدفوعات بعد الخصومات</h5>
                                        <h2 class="mb-0 tx-22 mb-1 mt-1">{{$customer->billsDetails['total_after_discount']}}</h2>
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
                                        <h5 class="tx-13">المنتجات المشتراه</h5>
                                        <h2 class="mb-0 tx-22 mb-1 mt-1">{{$customer->billsDetails['total_items']->count()}}</h2>
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
                            
                                <li class="">
                                    <a href="#profile" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-images tx-15 mr-1"></i></span> <span class="hidden-xs">الفواتير</span> </a>
                                </li>
                                <li class="active">
                                    <a href="#home" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">الملف</span> </a>
                                </li>

                            </ul>
                        </div>
                        <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                            <div class="tab-pane" id="home">
                                <form role="form">
                                    <div class="form-group">
                                        <label for="name">الاسم</label>
                                        <input type="text" value="{{$customer->name}}" readonly id="name" name='name' class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">الايميل</label>
                                        <input type="email" value="{{$customer->email ?? '---'}}" readonly id="email" name='email' class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="phone">رقم الهاتف</label>
                                        <input type="string" value="{{$customer->phone}}" id="phone" readonly  name='phone' class="form-control">
                                    </div>
                                    
                                    
                                
                                    <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button>
                                </form>
                            </div>

                            <div class="tab-pane" id="profile">
                                <div class="row">
                                    @foreach ($customer->bills as $bill)
                                        <div class="col-sm-4">
                                                <div class="border p-1 card thumb">
                                                    <a 
                                                        href="{{route('bills.show',$bill->id)}}" 
                                                        class="image-popup" title="Screenshot-2"> 
                                                        <h4 class="text-center tx-14 mt-3 mb-0">{{$bill->created_by->name}}</h4>
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
                                </div>
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
