<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="{{ route('home') }}">LMS</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                <li><a class="{{ request()->routeIs('front.courses') ? 'active' : '' }}"
                        href="{{ route('front.courses') }}">Courses</a></li>
                @if (Auth::user() && Auth::user()->role == 'teacher')
                    <li><button type="button" data-bs-toggle="modal" data-bs-target="#create_join_course">Add
                            Course</button>
                    </li>
                @endif
                @if (Auth::user() && Auth::user()->role == 'student')
                    <li><button type="button" data-bs-toggle="modal" data-bs-target="#create_join_course">Join
                            Course</button>
                    </li>
                @endif

                {{-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="#">Drop Down 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i
                                    class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="#">Deep Drop Down 1</a></li>
                                <li><a href="#">Deep Drop Down 2</a></li>
                                <li><a href="#">Deep Drop Down 3</a></li>
                                <li><a href="#">Deep Drop Down 4</a></li>
                                <li><a href="#">Deep Drop Down 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Drop Down 2</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                    </ul>
                </li> --}}
            </ul>
            {{-- <i class="bi bi-list mobile-nav-toggle"></i> --}}
            <i class="fa-solid fa-bars mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        @if (Auth::user())
            <form action="{{ route('logout') }}" method="POST">@csrf <button type="submit"
                    class="get-started-btn">Logout</button></form>
        @else
            <a href="{{ route('login') }}" class="get-started-btn">Login</a>
        @endif

    </div>
</header>
<!-- Modal -->
<div class="modal fade" id="create_join_course" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{ route('create.course') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Course</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="role" value="{{ Auth::user()->role }}">
                    @if (Auth::user() && Auth::user()->role == 'teacher')
                        <div class="mb-3">
                            <label for="name" class="form-label">Course Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    @endif

                    @if (Auth::user() && Auth::user()->role == 'student')
                        <div class="mb-3">
                            <label for="code" class="form-label">Course Code</label>
                            <input type="text" class="form-control" id="code" name="code">
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>
