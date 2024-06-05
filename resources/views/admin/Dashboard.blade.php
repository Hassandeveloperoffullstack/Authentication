<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 Multi Auth :: Admin</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-md bg-white shadow-lg bsb-navbar bsb-navbar-hover bsb-navbar-caret">
        <div class="container">
            <a class="navbar-brand" href="#">
                <strong>Laravel 11 Multi Auth Admin</strong>
            </a>
           
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#!" id="accountDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Hello,
                                {{ Auth::guard('admin')->user()->name }}</a>
                            <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="accountDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    @if (Session::has('success'))
    {{-- <div class="alert alert-success">{{Session::get('success')}}</div> --}}
    <div class="alert alert-success alert-dismissible fade text-center show" role="alert">
        {{Session::get('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
        
    @endif
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-header bg-light">
                <h3 class="h5 pt-2">Dashboard</h3>
            </div>
            <div class="card-body">
                
              
                    <div class="col-12   mt-2">
                        <h1 class="text-center mt-2 mb-2">
                            All users
                        </h1>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td class="bg-dark text-light">
                                        Sr #
                                    </td>
                                    <td class="bg-dark text-light">
                                        Name
                                    </td>
    
                                    <td class="bg-dark text-light">
                                        Email
                                    </td>
                                    <td class="bg-dark text-light">
                                        Created At
                                    </td>
                                    <td class="bg-dark text-light" colspan="3">
                                       Operations
                                    </td>
                                </tr>
                            </thead>
                            @foreach ($data as $id => $users)
                                <tr>
                                   
                                    <td> {{ $i++  }} </td>
                                    <td> {{ $users->name }} </td>
                                    <td> {{ $users->email }} </td>
                                    <td> {{ $users->created_at }} </td>
                                    <td class="text-center"><a href="{{route('dashboard.updatePage',$users->id) }}" class="btn btn-outline-warning   btn-sm">Update</a>
                                    <a href="{{route('dashboard.delete',$users->id) }}" class="btn btn-outline-danger  btn-sm">Delete</a>

                                    @if ($users->block == 1)
                                 
                                    <a href="{{route('dashboard.unblock',$users->id) }}" class="btn btn-success  btn-sm">Un Block</a></td>
                                    
                                        
                                    @else
                                  
                                        
                                    <a href="{{route('dashboard.block',$users->id) }}" class="btn btn-outline-info  btn-sm">Block</a></td>
            
                                        
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
        
           
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
            </script>
</body>
</html>
