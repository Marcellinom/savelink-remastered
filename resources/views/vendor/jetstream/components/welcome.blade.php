<div class="p-2 sm:px-20 input bg-color shadow">
@if (session('alert'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <span type="button" class="" data-dismiss="alert" aria-label="Close">
                        <strong>Warning!</strong> {{ session('alert') }}
                      </span>
                    </div>
@endif
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
                <div class="input-button">
                  <button 
                  type="submit" 
                  class="btn btn-outline-success mt-2.5" 
                  style="padding: 5px 31px;">Save Link!</button>
                </div>
                <div>
                  <select 
                  name="select_tag"
                  class="custom-select" 
                  value="tag"
                  id="change">
                  @if(isset($data))
                  @foreach($data as $tag)
                    <option value="{{$tag}}">{{$tag}}</option>
                  @endforeach
                  @endif
                    <option value="Add-Tag">Add Tag</option> <!-- Trigger Modal -->
                  </select>
          </form>  
</div>
