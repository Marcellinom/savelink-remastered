
@extends('layout/main')

@section('title', 'Home - Savelink')

@section('container')

<div class="container">
    <div class="row">
      <div class="col-10">
        <h1 class="mt-3">Main Page</h1>
      </div>
                  @if (session('alert'))
                      <div class="alert alert-danger text-center">
                          {{ session('alert') }}
                      </div>
                  @endif
        <form action="" method="POST">
          @csrf
          <div class="row">
            <h2 style="text-align: center;">
                <div class="input-title">
                  <input type="text" placeholder="Name(optional)" name="name"></input>
                </div>
                <div class="input-url">
                  <input type="text" placeholder="url" name="url"></input>
                </div>
                <br>
                <div class="input-button">
                <button class="btn btn-primary" value="school-btn" data-loading-text="Loading..." id="myBtn" name="action" style="padding: 10px 31px;">
                    SCHOOL LINK
                  </button>  
                  <button class="btn btn-danger" value="pekob-btn" data-loading-text="Loading..." id="myBtn" name="action" style="padding: 10px 31px;">
                    PEKOB LINK
                  </button>  
                </div>
            </h2>
          </div>
        </form>  

    </div>
  </div>
@endsection