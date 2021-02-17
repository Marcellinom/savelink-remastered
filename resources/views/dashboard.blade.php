@extends('layouts/app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
<div class="hidden-input">
    <div class="py-12">
        <div style="width:300px; margin: -100px 0 0 -150px; top: 50%; left: 50%;  position:absolute;">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-2 sm:px-20 input bg-color shadow">
@if (session('alert'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <span type="button" class="" data-dismiss="alert" aria-label="Close">
                        <strong>Warning!</strong> {{ session('alert') }}
                      </span>
                    </div>
@endif

<img src="{{asset('img/logo.png')}}" width="300px">
        <form action="/input" method="post">
          @csrf
          <div class="row">
            <h2 style="text-align: center;">
                <div class="input-title">
                  <input class="custom-input" type="text" placeholder="Name(optional)" name="name"></input>
                </div>
                <div class="input-url">
                  <input class="custom-input" type="text" placeholder="url" name="url"></input>
                </div>
                <div>
                  <select 
                  name="select_tag"
                  class="custom-select" 
                  value="tag"
                  id="select-tag">
                  @if(isset($data))
                  @foreach($data as $tag)
                    <option value="{{$tag}}">{{$tag}}</option>
                  @endforeach
                  @endif
                    <option value="Add-Tag">Add Tag</option> <!-- Trigger Modal -->
                  </select>
                </div>
                <div class="input-button">
                  <button 
                  type="submit" 
                  class="btn btn-outline-success mt-2.5" 
                  style="padding: 5px 31px;">Save Link!</button>
                </div>
           </div>
        </form>  
    </div>
      </div>
        </div>
          </div>
</div>
    <script type="text/javascript">
$( document ).ready(function() {
    $( "#select-tag" ).change(function() {
      var val = $(this).val();
      if(val === 'Add-Tag'){
        $('#add-tag-modal').modal('show')
      }
    });
    $('.input-trigger').on('click', function (e) {
        $('.hidden-input').toggle(); 
    });
});
</script>
@endsection
