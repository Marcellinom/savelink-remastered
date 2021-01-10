
@extends('layout/main')

@section('title', 'Home - Savelink')

@section('container')
<style>
br{
  content: "";
  margin: 0.5em; 
  display: block;
}
</style>
<div class="container">
    <div class="row">
      <div class="col-10">
        <h1 class="mt-3">Main Page</h1>
      </div>

        <form action="" method="POST">
          @csrf
          <div class="row">
            <h2 style="text-align: center;">
                <div class="input-title">
                  <input type="text" placeholder="Name" name="name"></input>
                </div>
                <div class="input-url">
                  <input type="text" placeholder="url" name="url"></input>
                </div>
                <br>
                <div class="input-button">
                  <button class="btn btn-sm btn-outline-secondary" name="action" value="school-btn" style="padding: 10px 31px;">
                    SCHOOL LINK
                  </button>  
                  <button class="btn btn-sm btn-outline-secondary" name="action" value="pekob-btn" style="padding: 10px 31px;">
                    PEKOB LINK
                  </button>  
                </div>
            </h2>
          </div>
        </form>  

    </div>
  </div>
@endsection