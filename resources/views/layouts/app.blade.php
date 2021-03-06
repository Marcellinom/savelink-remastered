<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta itemprop="og:title" content="Savelink - Save your links!">
        <meta itemprop="og:description" content="Savelink is an app where you can store and manage your precious links!">
        <meta itemprop="og:image" content="{{asset('img/logo2.png')}}">
        
        <meta property="og:title" content="Savelink - Save your links!">
        <meta property="og:description" content="Savelink is an app where you can store and manage your precious links!">
        <meta property="og:image" content="{{asset('img/logo2.png')}}">

        <title>{{isset($title)? $title:(request()->routeIs('account')?"Profile":"Home")}} - Savelink</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">	      
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">	      
        <link rel="stylesheet" href="{{ asset('css/driver.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <!-- Js Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
       
        @livewireStyles
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen" style="background-color: #2a2636;">
            <!-- NavBar -->
            @include('navigation-menu')

            <!-- Page Heading -->
              @if(isset($title))
                <header class="custom bg-header shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 title-header">
                      {{$title}} - Links
                      @if($nsfw_mark != null)
                      <span class="nsfw-tag sm:px-4" style="font-size:18px;">
                        <mark style="background-color:red; border-radius:12px;">(NSFW)</mark>
                      </span>
                      @endif
                    </div>
                </header>
              @endif

            <!-- Page Content -->
            <main>
            @yield('content')
            </main>
        </div>
<!-- MODAL ADD TAG -->
        <form action="/addTag" method="post">
          @csrf
            <div class="modal fade" id="add-tag-modal" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Add New Tag</h4>
                  </div>
                  <div class="modal-body">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">Input</span>
                    </div>
                    <input type="text" class="form-control" name="add"></input>
                  </div>
                  <input class="form-check-input ml-2" type="checkbox" value=1 name="nsfw" id="check-nsfw-modal">
                  <label class="form-check-label" for="check-nsfw-modal">
                    NSFW
                  </label>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
      </form>
<!-- END MODAL ADD TAG -->
        @livewireScripts
    </body>
</html>
