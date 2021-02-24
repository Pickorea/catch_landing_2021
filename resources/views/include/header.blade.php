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
        </div>
      </li>
      </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav></div>
