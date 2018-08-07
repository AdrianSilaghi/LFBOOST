<nav class="navbar navbar-expand-lg border-grey-light border-b border-t h-12 navbar-light bg-light" id="catNav">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
       
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/dashboard">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Selling</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('dashboardOrders')}}">Orders</a>
                  <a class="dropdown-item" href="{{route('myBoosts')}}">My boosts</a>
                  <a class="dropdown-item" href="{{route('earnings')}}">Earnings</a>
              </li>
            <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard.getContacts')}}">Inbox</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{route('account')}}">Settings</a>
              </li>
        </ul>
      </div>
    </div>
    </nav>
  