
<!-- start: header -->
        <header class="header">
            <div class="logo-container">
                <!-- <a href="../" class="logo">
						<img src="assets/images/logo.png" height="35" alt="JSOFT Admin" />
                    </a> -->
                <h3 class="logo">URGENCE</h3>
                <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>

            <!-- start: search & user box -->
            <div class="header-right">

                <span class="separator"></span>

                <div id="userbox" class="userbox">
                    <a href="#" data-toggle="dropdown">
                         <figure class="profile-picture">
								<img src="{{ asset('template/octopus/assets/images/!logged-user.jpg')}}" class="img-circle" data-lock-picture="{{ asset('template/octopus/assets/images/!logged-user.jpg')}}" />
							</figure>
                        <div class="profile-info" data-lock-name="John Doe" data-lock-email="{{ Auth::user()->email }}">
                            <span class="name">{{ (Auth::user()->name) ? Auth::user()->name : '' }}</span>
                            <span class="role">{{ (Auth::user()->typeUtilisateur) ? Auth::user()->typeUtilisateur : '' }}</span>
                        </div>

                        <i class="fa custom-caret"></i>
                    </a>

                    <div class="dropdown-menu">
                        <ul class="list-unstyled">
                            <li class="divider"></li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="{{ route('profile.index', ['id' => Auth::user()->id ]) }}"><i class="fa fa-user"></i> My Profile</a>
                            </li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end: search & user box -->
        </header>
        <!-- end: header -->