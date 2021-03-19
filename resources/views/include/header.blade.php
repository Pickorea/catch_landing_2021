@auth
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ URL::route('home') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Module Management
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('island.index') }}">Islands</a>
                            <a class="dropdown-item" href="{{ route('location.index') }}">Locations</a>
                            <a class="dropdown-item" href="{{ route('species.index') }}">Species</a>
                            <a class="dropdown-item" href="{{ route('method.index') }}">Methods</a>
                            <a class="dropdown-item" href="{{ route('trip.index') }}">Trips</a>
                            <a class="dropdown-item" href="{{ route('fisherman.index') }}">Fisherman</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('tripreport.index')}}">Report</a>
                            <a class="dropdown-item" href="{{route('sum.weightbymonth')}}">Weight by Month</a>
                            <a class="dropdown-item" href="{{route('sum.weightbyyear')}}">Weight by Year</a>
                            <a class="dropdown-item" href="{{route('cpue.island')}}">CPUE by island</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
@endauth

