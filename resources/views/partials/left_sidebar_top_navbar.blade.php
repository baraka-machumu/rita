<div class="col-md-3 left_col" style="margin-top: -1px;">
    <div class="left_col scroll-view" style="background-color: #3D3D3D;">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title" style="background-color: #0E6BB7; height: 65px;">
                <img  src="{{asset(url('public/resource/images/imglogo.png'))}}" height="30" width=30/><span> RITA</span></a>
        </div>

        <div class="clearfix"></div>
        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" style="background-color: #3D3D3D" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">

                <ul class="nav side-menu">

                    <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i> Dashboard </a></li>


                    <li><a><i class="fa fa-ring"></i> Birth Management<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">

                            <li><a>New Birth certificates<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">

                                    <li><a href="{{url('birth-certificates/1/new-request')}}">Requests</a>
                                    </li>

                                    <li><a href="{{url('birth-certificates/1/new-processing')}}">Processing</a>
                                    </li>

                                    <li><a href="{{url('birth-certificates/1/new-issue')}}">Issue</a>
                                    </li>

                                </ul>
                            <li><a >Replace Old  Certificate<span class="fa fa-chevron-down"></span></a>

                                <ul class="nav child_menu">

                                    <li><a href="{{url('birth-certificates/replace/1/request')}}">Requests</a>
                                    </li>

                                    <li><a href="{{url('birth-certificates/replace/1/issue')}}">Issue</a>
                                    </li>

                                </ul>

                            </li>


                            <li><a>Duplicate  Certificate<span class="fa fa-chevron-down"></span></a>

                                <ul class="nav child_menu">

                                    <li><a href="{{url('birth-certificates/duplicate/1/request')}}">Requests</a>
                                    </li>

                                    <li><a href="{{url('birth-certificates/duplicate/1/issue')}}">Issue</a>
                                    </li>

                                </ul>

                            </li>

                            <li><a >Change  Certificate Details<span class="fa fa-chevron-down"></span></a>

                                <ul class="nav child_menu">

                                    <li><a href="{{url('birth-certificates/correction/1/request')}}">Requests</a>
                                    </li>

                                    <li><a href="{{url('birth-certificates/correction/1/issue')}}">Issue</a>
                                    </li>

                                </ul>

                            </li>
                            <li><a href="{{url('birth-certificates/1/verify')}}">Verification Requests</a></li>

                            <li><a href="{{url('birth-certificates/search')}}">Search Service</a></li>

                        </ul>
                    </li>


                    @if(App\Manager::can(Config::get('rolecode.DeathManagement')))


                        <li><a><i class="fa fa-ring"></i> Death Management<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">

                                <li><a>New Death certificates<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">

                                        <li><a href="{{url('death-certificates/1/new-request')}}">Requests</a>
                                        </li>

                                        <li><a href="{{url('death-certificates/1/new-processing')}}">Processing</a>
                                        </li>

                                        <li><a href="{{url('death-certificates/1/new-issue')}}">Issue</a>
                                        </li>

                                    </ul>
                                <li><a >Replace Old  Certificate<span class="fa fa-chevron-down"></span></a>

                                    <ul class="nav child_menu">

                                        <li><a href="{{url('death-certificates/replace/1/request')}}">Requests</a>
                                        </li>

                                        <li><a href="{{url('death-certificates/replace/1/issue')}}">Issue</a>
                                        </li>

                                    </ul>

                                </li>


                                <li><a>Duplicate  Certificate<span class="fa fa-chevron-down"></span></a>

                                    <ul class="nav child_menu">

                                        <li><a href="{{url('death-certificates/duplicate/1/request')}}">Requests</a>
                                        </li>

                                        <li><a href="{{url('death-certificates/duplicate/1/issue')}}">Issue</a>
                                        </li>

                                    </ul>

                                </li>

                                <li><a >Change  Certificate Details<span class="fa fa-chevron-down"></span></a>

                                    <ul class="nav child_menu">

                                        <li><a href="{{url('death-certificates/correction/1/request')}}">Requests</a>
                                        </li>

                                        <li><a href="{{url('death-certificates/correction/1/issue')}}">Issue</a>
                                        </li>

                                    </ul>

                                </li>
                                <li><a href="{{url('death-certificates/1/verify')}}">Verification Requests</a></li>

                                <li><a href="{{url('death-certificates/search')}}">Search Service</a></li>

                            </ul>
                        </li>
                    @endif

                    @if(App\Manager::can(Config::get('rolecode.MarriageDivorce')))

                        <li><a><i class="fa fa-life-ring"></i> Marriage And Divorce<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">

                                <li><a >Marriage <span class="fa fa-chevron-down"></span></a>

                                    <ul class="nav child_menu">
                                        <li><a href="{{url('birth-certificates/duplicates53')}}">Notice To Be Married</a></li>
                                        <li><a href="{{url('birth-certificates/duplicates11')}}">New Marriage Registration(Tanzania MainLand)</a></li>
                                        <li><a href="{{url('birth-certificates/duplicates34')}}">New Marriage Registration(Abroad)</a></li>
                                        <li><a href="{{url('birth-certificates/duplicates77')}}">Endorsement Of Marriage Register</a></li>

                                    </ul>
                                </li>

                                <li><a >Divorce <span class="fa fa-chevron-down"></span></a>

                                    <ul class="nav child_menu">
                                        <li><a href="{{url('birth-certificates/duplicatesd')}}">Registration Of Divorce</a></li>
                                        <li><a href="{{url('birth-certificates/duplicatesw')}}">Registration Of Annulment and Divorce</a></li>
                                        <li><a href="{{url('birth-certificates/duplicatesh')}}">Registration Of Foreign Annulment And Divorce</a></li>

                                    </ul>
                                </li>

                                <li><a >Registra <span class="fa fa-chevron-down"></span></a>

                                    <ul class="nav child_menu">
                                        <li><a href="{{url('birth-certificates/duplicates1')}}">License Of Marriage Registrar</a></li>
                                        <li><a href="{{url('birth-certificates/duplicates2')}}">Renew Marriage  Registrar License </a></li>

                                    </ul>
                                </li>

                            </ul>
                        </li>

                    @endif

                    @if(App\Manager::can(Config::get('rolecode.RegistrationTrustee')))

                        <li><a><i class="fa fa-life-ring"></i>Registration Of Trustees<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{url('birth-certificates3')}}">Registration Of Trustees</a></li>


                            </ul>
                        </li>

                    @endif
                    @if(App\Manager::can(Config::get('rolecode.AdoptionChildren')))

                        <li><a><i class="fa fa-life-ring"></i>Adoption Of Children<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{url('birth-certificates4')}}">Adoption Of Children</a></li>


                            </ul>
                        </li>
                    @endif

                    @if(App\Manager::can(Config::get('rolecode.ManagementSettings')))

                        <li><a><i class="fa fa-cog"></i> Management settings <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{url('users')}}">Users</a></li>

                                <li><a href="{{url('roles')}}">Roles</a></li>

                                <li><a href="{{url('permissions')}}">Permissions</a></li>

                                <li><a href="{{url('departments')}}">Departments</a></li>

                                <li><a href="{{url('hospitals')}}">Health Facility</a></li>
                                <li><a href="{{url('offices')}}">Rita Offices</a></li>

                                <li><a href="{{url('regions')}}">Regions</a></li>
                                <li><a href="{{url('districts')}}">Districts</a></li>

                                <li><a href="{{url('hospitals')}}">Service Group</a></li>
                                <li><a href="{{url('offices')}}">Service Type</a></li>

                            </ul>
                        </li>

                    @endif

                    @if(App\Manager::can(Config::get('rolecode.Report')))

                        <li><a><i class="fa fa-book"></i> Reports <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{url('reports')}}">All Registered Certificates</a></li>


                            </ul>
                        </li>

                    @endif

                    <li><a href="{{url('advanced-search')}}"><i class="fa fa-search"></i> Advanced Search </a></li>

                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

    </div>
</div>

<!-- top navigation -->
<div class="top_nav"  >
    <div class="nav_menu" style="background-color: #0E6BB7; height: 65px;">
{{--        <div class="nav toggle" >--}}
{{--            <a id="menu_toggle" ><i class="fa fa-bars" style="background-color: white;"></i></a>--}}
{{--        </div>--}}
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px; color: white;">
                    <a style="color: white;" href="javascript:;" class="fa fa-power-off dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">

                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item"  href="javascript:;">{{auth()->user()->Username}}</a>
                             <?php ?>
                        <a class="dropdown-item"  href="javascript:;"> Office {{App\User::office()}} </a>

                        <a class="dropdown-item btn"  href="{{url('logout')}}" >

                            <i class="fa fa-sign-out pull-right"></i>

                            Log Out

                        </a>

                        {{--                        <form action="{{url('logout')}}" method="post">--}}

                    </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                    {{--                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">--}}
                    {{--                        <i class="fa fa-envelope-o"></i>--}}
                    {{--                        <span class="badge bg-green">6</span>--}}
                    {{--                    </a>--}}
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                        <li class="nav-item">
                            <a class="dropdown-item">
                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                                <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item">
                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                                <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item">
                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                                <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item">
                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                                <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class="text-center">
                                <a class="dropdown-item">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
