@extends('layouts/app')
@section('content')
<div class="main-body py-7">
    @if (session('alert'))
    <div style="text-align: center;" class="custom alert alert-warning alert-dismissible fade show" role="alert">
      <span type="button" class="" data-dismiss="alert" aria-label="Close">
        <strong>Warning!</strong> {{ session('alert') }}
      </span>
    </div>
    @elseif(session('alert_danger'))
    <div style="text-align: center;" class="alert alert-danger alert-dismissible fade show" role="alert">
      <span type="button" class="" data-dismiss="alert" aria-label="Close">
        <strong>Warning!</strong> {{ session('alert_danger') }}
      </span>
    </div>
    @endif
    <br>
    <div style="card bg-table">
        <div class="p-2 sm:px-20 view bg-color shadow t">

            <div class="custom table-responsive text-white">
                <button type="button" class="btn btn-success ml-2 btn-circle btn-sm"
                data-toggle="modal" data-target="#purge{{str_replace(" ","-",$title)}}"></button>
                <button type="button" class="btn btn-warning ml-2 btn-circle btn-sm"
                data-toggle="modal" data-target="#edit{{str_replace(" ","-",$title)}}"></button>
                <button type="button" 
                class="btn btn-danger ml-2 btn-circle btn-sm" 
                data-toggle="modal" data-target="#delete{{str_replace(" ","-",$title)}}"></button>
<!-- Delete -->
<form action="/delete" method="post">
@csrf
    <div class="modal fade" id="delete{{str_replace(" ","-",$title)}}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    Are you sure you wan't to<br><strong> DELETE <u>{{$title}}</u> Tab?</strong>
                    <input type="hidden" value="{{$title}}" name="tag">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
    </div>
</form>
<!-- Edit -->
        <form action="/edit" method="post">
        @csrf
            <div class="modal fade" id="edit{{str_replace(" ","-",$title)}}" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <h class="text-black">Edit Tag Name</h>
                  </div>
                  <div class="modal-body">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">Input New Tag</span>
                    </div>
                    <input type="text" class="form-control" name="new" value="{{$title}}"></input>
                    <input type="hidden" name="old" value="{{$title}}"></input>
                  </div>
                  <input class="form-check-input ml-2" 
                  type="checkbox" value=1 name="nsfw" 
                  id="check-nsfw-modal" @if($nsfw_title->nsfw != null) checked @endif>
                <label style="color:black;">
                    NSFW
                </label>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
        </form>
<!-- Purge -->
<form action="/purge" method="post">
@csrf
    <div class="modal fade" id="purge{{str_replace(" ","-",$title)}}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-warning" role="alert">
                    Are you sure you wan't to<br> <strong>PURGE <u>{{$title}}</u> Tab?</strong>
                    <input type="hidden" value="{{$title}}" name="tag">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-warning">Purge</button>
            </div>
        </div>
    </div>
    </div>
</form>
<!-- --- -->
<table id="tabel" class="table table-striped table-bordered">

    <thead>
        <tr>
            <th data-priority="1" width = "5%" class="text-gray-400">Edit</th>
            <th data-priority="2" width = "40%" class="text-gray-400">Link</th>
            <th data-priority="3" width = "20%" class="text-gray-400">Created At</th>
         </tr>
    </thead>
    <tbody>
        @foreach ($list_items as $index=>$item)
        <tr>   
<td class="text-white">
                <button type="button" 
                class="btn btn-danger ml-2 btn-circle btn-sm" 
                data-toggle="modal" data-target="#delete{{ $item->id }}"></button>
                <button type="button" class="btn btn-warning ml-2 btn-circle btn-sm"
                data-toggle="modal" data-target="#edit{{ $item->id }}"></button>
                <button type="button" class="btn btn-success ml-2 btn-circle btn-sm"
                data-toggle="modal" data-target="#move{{ $item->id }}"></button>

        <!-- Delete Content -->
        <form action="/dcontent" method="post">
        @csrf
            <div class="modal fade" id="delete{{ $item->id }}">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="alert alert-danger" role="alert">
                        Are you sure you wan't to<br><strong> DELETE <br><u>{{$item->name}}</u></strong>
                        <input type="hidden" value="{{$item->id}}" name="delete_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
            </div>
        </form>

        <!-- Edit Content -->
        <form action="/econtent" method="post">
        @csrf
            <div class="modal fade" id="edit{{ $item->id }}" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <h class="text-black">Edit Content</h>
                  </div>
                  <div class="modal-body">
                  <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Input New Title</span>
                        </div>
                            <input type="text" class="form-control" name="new_title" value="{{$item->name}}"></input>
                            <input type="hidden" name="old_title" value="{{$item->name}}"></input>
                  </div>
                  <div class="input-group-prepend">
                  <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">Input New Url</span>
                    </div>
                    <input type="text" class="form-control" name="new_url" value="{{$item->url}}"></input>
                    <input type="hidden" name="old_url" value="{{$item->url}}"></input>
                  </div>
                  <input class="form-check-input ml-2" 
                  type="checkbox" value=1 name="nsfw" 
                  id="check-nsfw-modal" @if(isset($item->img)) checked @endif>
                <label style="color:black;">
                    NSFW
                </label>
                  </div>
                  <div class="modal-footer">
                  <input type="hidden" value="{{$title}}" name="tag">
                  <input type="hidden" value="{{$item->id}}" name="edit_id">
                  <input type="hidden" value="{{$item->img_url}}" name="old_img_url">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
        </form>

        <!-- Move Content -->
        <form action="/mcontent" method="post">
        @csrf
            <div class="modal fade" id="move{{ $item->id }}">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="input-group-text" id="basic-addon1">
                        <div class="span-text">
                            Move to
                        </div>    
                        <div class="span-select ml-5">
                            <select 
                                name="select_tag"
                                class="custom-select" 
                                value="tag"
                                id="select-tag{{$item->id}}">
                            @if(isset($data))
                            @foreach($data as $tag)
                                <option value="{{$tag}}">{{$tag}}</option>
                            @endforeach
                            @endif
                                <option value="Add-Tag">Add Tag</option> <!-- Trigger Modal -->
                            </select>
                        </div>
                        </span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="{{$item->img}}" name="nsfw">
                        <input type="hidden" value="{{$item->id}}" name="move_id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Move</button>
                    </div>
                </div>
            </div>
            </div>
        </form>
<script type="text/javascript">
$( document ).ready(function() {
    $( "#select-tag{{$item->id}}" ).change(function() {
      var val = $(this).val();
      if(val === 'Add-Tag'){
        $('#add-tag-modal').modal('show')
      }
    });
});
</script>
</td>
                <td class="text-white">
                    <?php if(str_contains($item->url, "youtube.com/embed/")) : ?>
                        <iframe src={{$item->url}} 
                        {{(new \Jenssegers\Agent\Agent())->isMobile()?
                        'width =200px; height=110px':'width =500px; height=310px'}} 
                        allowfullscreen="allowfullscreen"
                        mozallowfullscreen="mozallowfullscreen" 
                        msallowfullscreen="msallowfullscreen" 
                        oallowfullscreen="oallowfullscreen" 
                        webkitallowfullscreen="webkitallowfullscreen"></iframe>

                    <?php elseif($isTouch = isset($item->img_url)) : ?>
                        {{$item->name}}
                            <a onclick="window.open(this.href); return false;" href = {{ $item->url }}>
                        @if((new \Jenssegers\Agent\Agent())->isMobile())
                            <embed type="image/jpg" src={{ $item->img_url }} width="200px" height="200px">
                        @else
                        <embed type="image/jpg" src={{ $item->img_url }} width="300px" height="300px">
                        @endif
                    
                    <?php else : ?>
                            <a onclick="window.open(this.href); return false;" href = {{ $item->url }}>{{  $item->name }}</a>
                    <?php endif; ?>
                </td>
                <td class="text-white">{{ $item->time }}</td>
        </tr>
       @endforeach
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" defer></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" defer></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#tabel').DataTable();
});
</script>
</div>
</table>
</div>
</div>
</div>
</div>
@endsection