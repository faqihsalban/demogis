<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li>
                    <a href="{{route('dashboard')}}">
                        <i class="iconsminds-shop-4"></i> Dashboards
                    </a>
                </li>
                    <li>
                        <a href="#management">
                            <i class="iconsminds-folder"></i>
                            <span>Data Management</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="#content">
                            <i class="iconsminds-folder"></i>
                            <span>Content Management</span>
                        </a>
                    </li> --}}
                    {{-- <li>
                        <a href="#survey">
                            <i class="iconsminds-folder-edit"></i>
                            <span>Report Data</span>
                        </a>
                    </li> --}}
                    {{-- <li>
                        <a href="{{route('chat.index')}}">
                            <i class="iconsminds-mail"></i>Chat
                        </a>
                    </li>
                    <li>
                        <a href="{{route('user.index')}}">
                            <i class="iconsminds-male-female"></i> User
                        </a>
                    </li> --}}
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="management" id="management">
                <li>
                    <a href="#" data-toggle="collapse" data-target="#collapseAuthorization" aria-expanded="true"
                        aria-controls="collapseAuthorization" class="rotate-arrow-icon opacity-50">
                        <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Data</span>
                    </a>
                    <div id="collapseAuthorization" class="collapse show">
                        <ul class="list-unstyled inner-level-menu">
                            <li>
                                <a href="{{route('space.index')}}">
                                    <i class="iconsminds-medicine-3
                                    "></i> <span
                                        class="d-inline-block">Asset Spaces</span>
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{route('food.index')}}">
                                    <i class="iconsminds-hamburger"></i> <span
                                        class="d-inline-block">Food</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('activityimage.index')}}">
                                    <i class="iconsminds-chopsticks"></i> <span
                                        class="d-inline-block">Activity Image</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('activity.index')}}">
                                    <i class="iconsminds-running-shoes"></i> <span
                                        class="d-inline-block">Activity</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('portion.index')}}">
                                    <i class="iconsminds-glass-water"></i> <span
                                        class="d-inline-block">Portion</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('menu-recoment.index')}}">
                                    <i class="iconsminds-chopsticks"></i> <span
                                        class="d-inline-block">Menu</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('faq.index')}}">
                                    <i class="iconsminds-idea"></i> <span
                                        class="d-inline-block">FAQ</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('mheifood.index')}}">
                                    <i class="iconsminds-chopsticks"></i> <span
                                        class="d-inline-block">MHEI Food</span>
                                </a>
                            </li> --}}

                            {{-- <li>
                                <a href="{{route('foodhistory.index')}}">
                                    <i class="iconsminds-hamburger"></i> <span
                                        class="d-inline-block">Food History</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
            </ul>
            {{-- <ul class="list-unstyled" data-link="content" id="content">
                <li>
                    <a href="#" data-toggle="collapse" data-target="#collapseAuthorization1" aria-expanded="true"
                        aria-controls="collapseAuthorization1" class="rotate-arrow-icon opacity-50">
                        <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Content</span>
                    </a>
                    <div id="collapseAuthorization1" class="collapse show">
                        <ul class="list-unstyled inner-level-menu">
                            <li>
                                <a href="{{route('content.show.type','artikel')}}">
                                    <i class="simple-icon-book-open"></i> <span
                                        class="d-inline-block">Artikel</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('content.show.type','modul')}}">
                                    <i class="simple-icon-docs"></i> <span
                                        class="d-inline-block">Modul</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('content.show.type','page')}}">
                                    <i class="simple-icon-notebook"></i> <span
                                        class="d-inline-block">Page</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('content.show.type','video')}}">
                                    <i class="iconsminds-play-music"></i><span
                                        class="d-inline-block">Video</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('content.show.type','poster')}}">
                                    <i class="simple-icon-pin"></i> <span
                                        class="d-inline-block">Poster</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="list-unstyled" data-link="survey" id="survey">
                <li>
                    <a href="#" data-toggle="collapse" data-target="#collapseAuthorization2" aria-expanded="true"
                        aria-controls="collapseAuthorization2" class="rotate-arrow-icon opacity-50">
                        <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Content</span>
                    </a>
                    <div id="collapseAuthorization2" class="collapse show">
                        <ul class="list-unstyled inner-level-menu">
                            <li>
                                <a href="{{route('ipaq.index')}}">
                                    <i class="simple-icon-book-open"></i> <span
                                        class="d-inline-block">IPAQ</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('psqi.index')}}">
                                    <i class="simple-icon-book-open"></i> <span
                                        class="d-inline-block">PSQI</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('efficacy.index')}}">
                                    <i class="simple-icon-book-open"></i> <span
                                        class="d-inline-block">Self Efficacy</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('hei.index')}}">
                                    <i class="simple-icon-book-open"></i> <span
                                        class="d-inline-block">HEI History</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('foodhistory.index')}}">
                                    <i class="simple-icon-book-open"></i> <span
                                        class="d-inline-block">Food Recall</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('activityhistory.index')}}">
                                    <i class="simple-icon-book-open"></i> <span
                                        class="d-inline-block">Activity Recall</span>
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{route('hei.index')}}">
                                    <i class="simple-icon-book-open"></i> <span
                                        class="d-inline-block">Compliance Recall</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('hei.index')}}">
                                    <i class="simple-icon-book-open"></i> <span
                                        class="d-inline-block">User Detail History</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
            </ul> --}}
        </div>
    </div>
</div>
