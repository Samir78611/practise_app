@if(Session::has('success'))
        <h1 style="color:#006666">{{ Session::get('success') }}</h1>
    @endif

    @if(Session::has('fail'))
        <h1 style="color:#ff0000">{{ Session::get('fail') }}</h1>
    @endif


    <div class="navbar">

        <div class="user-info">
            <h3>Samir Qureshi</h3><br>
            <img src="{{ url('logo/user-interface.png') }}" alt="">
            <a href="{{ url('logout') }}" class="btn btn-danger">Logout</a>

        </div>
    </div>
    <h2>
        <a href="{{ url('blogs') }}">Blogs</a> | <a
            href="{{ url('cars') }}">Cars</a>
        <a href="{{ url('offer') }}">Zomato Offer</a>
    </h2>