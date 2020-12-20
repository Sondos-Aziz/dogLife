 <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container sidebar-closed sbar-open" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">
            
            <nav id="sidebar">

                <ul class="navbar-nav theme-brand flex-row  text-center">
                    <li class="nav-item theme-logo">
                        <a href="index.html">
                            <img src="{{asset('assets/en/img/90x90.jpg')}}" class="navbar-logo" alt="logo">
                        </a>
                    </li>
                    <li class="nav-item theme-text">
                        <a href="index.html" class="nav-link"> CORK </a>
                    </li>
                </ul>

                <ul class="list-unstyled menu-categories" id="accordionExample">
               

                    <li class="menu active">
                        <a href="apps_contacts.html" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <a href="{{ route('dashboard')}}" class="nav-link ">
                                  <div>
                                    <span class="material-icons">    dashboard </span>
                                         <span>Dashboard</span>
                                  </div>
                                </a>
                            </div>
                        </a>
                    </li>

                    <li class="menu active">
                        <a href="apps_contacts.html" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <a href="{{route('news.index')}}" class="nav-link ">
                                  <div>
                                     {{--<i class="fa fa-flag mr-1 ml-1" aria-hidden="true"></i>--}}
                                      <span class="material-icons">location_city</span>
                                    <span>{{trans('menu.news')}}</span>
                                  </div>
                                </a>
                            </div>
                        </a>
                    </li>

                   

                    <li class="menu">
                        <a href="apps_contacts.html" aria-expanded="false">
                            <div class="">
                                <a href="{{route('contacts.index')}}" class="nav-link ">
                                    <div>
                                        <i class="material-icons">message</i>
                                        <span>{{trans('menu.contact')}}</span>
                                    </div>
                                </a>
                            </div>
                        </a>
                    </li>

                    {{-- <li class="menu">
                        <div class="">
                        <a href="{{route('get-notifications')}}" class="nav-link ">
                            <div>
                                <span class="material-icons">  notifications</span>
                                <span>{{trans('menu.notifications')}}</span>
                            </div>
                            
                        </a>
                        </div>
                    </li> --}}
                    <li class="menu " >
                        <a href="#notifications" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span class="material-icons" style="margin-left: 3px">notifications</span>
                                <span>{{trans('menu.notifications')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="notifications" data-parent="#accordionExample">
                          
                        <li class="menu">
                            <div class="">
                            <a href="{{route('send-notifications')}}" class="nav-link ">
                                <div>
                                    <span class="material-icons">  notifications</span>
                                    <span> @lang('general.Send')</span>
                                </div>
                                
                            </a>
                            </div>
                        </li>
                        <li class="menu">
                            <div class="">
                            <a href="{{route('unreadNotifications')}}" class="nav-link ">
                                <div>
                                    <span class="material-icons">  notifications</span>
                                    <span> @lang('general.unreadNotifications')</span>
                                </div>
                                
                            </a>
                            </div>
                        </li>
                       
                    </ul>
                </li>


                    <li class="menu " >
                        <a href="#setting" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span class="material-icons" style="margin-left: 3px">settings</span>
                                <span>{{trans('menu.setting')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="setting" data-parent="#accordionExample">
                            <li>
                                <a href="{{route('policies.index')}}" class="nav-link ">
                                    <div>
                                        <span class="material-icons">  privacy_tip</span>
                                        <span>{{trans('menu.policies')}}</span>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('about_app.index')}}" class="nav-link ">
                                    <div>
                                        <span class="material-icons">  tablet_android</span>
                                        <span>{{trans('menu.about_app')}}</span>
                                    </div>
                                </a>
                            </li>
                          
                        </ul>
                    </li>


                </ul>
                
            </nav>

        </div>
        <!--  END SIDEBAR  -->
    

    </div>
    <!-- END MAIN CONTAINER -->