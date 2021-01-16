<!doctype html>
<html lang="en">

  <head > 
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    <!-- <script type="text/javascript" src="{{ asset('js/app.js') }}"></script> -->
    
<title>@yield('title')</title>
  </head>
  
  <!-- <body style="background-color:#323652;"> -->
  <body>  
    <div class="container">
      <nav class="navbar navbar-light bg-#323652">
        <form class="container-fluid justify-content-start">
          @if(basename($_SERVER['PHP_SELF']) != ('pekob') && basename($_SERVER['PHP_SELF']) != ('school'))
          <button class="btn active btn-outline-success me-1" type="button">
            <a class="nav-link active" id="schoolBtn" aria-current="page" href="{{ url('/') }}">
              <t style="color:white ">
                Home
              </t>
            </a>
          @else
          <button class="btn btn-outline-success me-1" type="button">
          <a class="nav-link active" id="schoolBtn" aria-current="page" href="{{ url('/') }}">
              <t style="color:green ">
                Home
              </t>
            </a>
          @endif
            
          </button>
          @if(basename($_SERVER['PHP_SELF']) == ('school'))
          <button class="btn btn-sm active btn-outline-secondary" type="button">
          @else
          <button class="btn btn-sm btn-outline-secondary" type="button">
          @endif
            <a class="nav-link active" id="schoolBtn" aria-current="page" href="{{ url('/school') }}">
              <t style="color:black">
                School
              </t>
            </a>
          </button>
          @if(basename($_SERVER['PHP_SELF']) == ('pekob'))
          <button class="btn btn-sm active btn-outline-secondary" type="button">
          @else
          <button class="btn btn-sm btn-outline-secondary" type="button">
          @endif
            <a class="nav-link active" id="pekobBtn" aria-current="page" href="{{ url('/pekob') }}">  
              <t style="color:black">
                Pekob
              </t>
            </a>
          </button>
        </form>
      </nav>
    </div>
@yield('container')

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>