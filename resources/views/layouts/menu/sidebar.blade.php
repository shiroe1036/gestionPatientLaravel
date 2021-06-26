            <!-- start: sidebar -->
            <aside id="sidebar-left" class="sidebar-left">
                <div class="sidebar-header">
                    <div class="sidebar-title" style="color:white;">
                        Navigation
                    </div>
                    <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>
                <div class="nano">
                    <div class="nano-content">
                        <nav id="menu" class="nav-main" role="navigation">
                            <ul class="nav nav-main">
                                <li>
                                    <a href="{{ route('home') }}">
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                        <span>Accueil</span>
                                    </a>
                                </li>
                                <li class="nav-parent">
                                    <a>
                                        <i class="fa fa-wheelchair" aria-hidden="true"></i>
                                        <span>Patients</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        @if(Auth::user()->typeUtilisateur != 'medecin')
                                        <li>
                                            <a href="{{ route('patient.index') }}">
                                                <i class="fa fa-ambulance"></i>
                                                <span>Liste patients</span>
                                            </a>
                                        </li>
                                        @endif
                                        <li>
                                            <a href="{{ route('patient.index.attente') }}">
                                                <i class="fa fa-pause"></i>
                                                <span>En attente de traitement</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('patient.index.traiter') }}">
                                                <i class="fa fa-stethoscope"></i>
                                                <span>En cours de traitement</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('patient.index.archive') }}">
                                                <i class="fa fa-archive"></i>
                                                <span>Archive Patient</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @if(Auth::user()->typeUtilisateur != 'secretaire')
                                <li>
                                    <a href="{{ route('maladie.index') }}">
                                        <i class="fa fa-h-square" aria-hidden="true"></i>
                                        <span>Maladie</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('medoc.index') }}">
                                        <i class="fa fa-medkit" aria-hidden="true"></i>
                                        <span>Médicament</span>
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->typeUtilisateur == 'superAdmin')
                                <li>
                                    <a href="{{ route('utilisateur.index') }}">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                        <span>Utilisateurs</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </nav>
                    </div>

                </div>

            </aside>
            <!-- end: sidebar -->