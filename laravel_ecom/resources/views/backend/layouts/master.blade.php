<!DOCTYPE html>
<html lang="en" data-footer="true"
    data-override='{"attributes": {"placement": "vertical", "layout": "boxed" }, "storagePrefix": "ecommerce-platform"}'>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Laravel Ecom |@yield('title')</title>
    <meta name="description" content="Ecommerce Dashboard" />
    

    @include('backend.layouts.inc.style')


</head>

<body>
    <div id="root">
        <div id="nav" class="nav-container d-flex">
            <div class="nav-content d-flex">
                @include('backend.layouts.inc.logo')

                @include('backend.layouts.inc.user-menu')

                <!-- Icons Menu Start -->
                <ul class="list-unstyled list-inline text-center menu-icons">
                    <li class="list-inline-item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#searchPagesModal">
                            <i data-cs-icon="search" data-cs-size="18"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" id="pinButton" class="pin-button">
                            <i data-cs-icon="lock-on" class="unpin" data-cs-size="18"></i>
                            <i data-cs-icon="lock-off" class="pin" data-cs-size="18"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" id="colorButton">
                            <i data-cs-icon="light-on" class="light" data-cs-size="18"></i>
                            <i data-cs-icon="light-off" class="dark" data-cs-size="18"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" data-bs-toggle="dropdown" data-bs-target="#notifications" aria-haspopup="true"
                            aria-expanded="false" class="notification-button">
                            <div class="position-relative d-inline-flex">
                                <i data-cs-icon="bell" data-cs-size="18"></i>
                                <span class="position-absolute notification-dot rounded-xl"></span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end wide notification-dropdown scroll-out"
                            id="notifications">
                            <div class="scroll">
                                <ul class="list-unstyled border-last-none">
                                    <li class="mb-3 pb-3 border-bottom border-separator-light d-flex">
                                        <img src="img/profile/profile-1.jpg"
                                            class="me-3 sw-4 sh-4 rounded-xl align-self-center" alt="..." />
                                        <div class="align-self-center">
                                            <a href="#">Joisse Kaycee just sent a new comment!</a>
                                        </div>
                                    </li>
                                    <li class="mb-3 pb-3 border-bottom border-separator-light d-flex">
                                        <img src="img/profile/profile-2.jpg"
                                            class="me-3 sw-4 sh-4 rounded-xl align-self-center" alt="..." />
                                        <div class="align-self-center">
                                            <a href="#">New order received! It is total $147,20.</a>
                                        </div>
                                    </li>
                                    <li class="mb-3 pb-3 border-bottom border-separator-light d-flex">
                                        <img src="img/profile/profile-3.jpg"
                                            class="me-3 sw-4 sh-4 rounded-xl align-self-center" alt="..." />
                                        <div class="align-self-center">
                                            <a href="#">3 items just added to wish list by a user!</a>
                                        </div>
                                    </li>
                                    <li class="pb-3 pb-3 border-bottom border-separator-light d-flex">
                                        <img src="img/profile/profile-6.jpg"
                                            class="me-3 sw-4 sh-4 rounded-xl align-self-center" alt="..." />
                                        <div class="align-self-center">
                                            <a href="#">Kirby Peters just sent a new message!</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- Icons Menu End -->

                @include('backend.layouts.inc.menu')

                <!-- Mobile Buttons Start -->
                <div class="mobile-buttons-container">
                    <!-- Menu Button Start -->
                    <a href="#" id="mobileMenuButton" class="menu-button">
                        <i data-cs-icon="menu"></i>
                    </a>
                    <!-- Menu Button End -->
                </div>
                <!-- Mobile Buttons End -->
            </div>
            <div class="nav-shadow"></div>
        </div>

        <main>
            <div class="container mt-5">
                @yield('admin_content')
            </div>
        </main>
        @include('backend.layouts.inc.footer')
    </div>





    @include('backend.layouts.inc.script')



</body>

</html>
