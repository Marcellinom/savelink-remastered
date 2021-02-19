@extends('layouts/app')
@section('content')
<div class="main-body py-12">
    <div style="card bg-table">
        <div class="p-2 sm:px-20 view bg-color shadow t">
            <div class="custom table-responsive text-white">
                <button type="button" class="btn btn-success ml-2 btn-circle btn-sm"
                data-toggle="modal" data-target="#{{str_replace(" ","-",$title)}}purge"></button>
                <button type="button" class="btn btn-warning ml-2 btn-circle btn-sm"
                data-toggle="modal" data-target="#{{str_replace(" ","-",$title)}}edit"></button>
                <button type="button" 
                class="btn btn-danger ml-2 btn-circle btn-sm" 
                data-toggle="modal" data-target="#{{str_replace(" ","-",$title)}}delete"></button>
<!-- Delete -->
<form action="/delete" method="post">
@csrf
    <div class="modal fade" id="{{str_replace(" ","-",$title)}}delete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="alert alert-danger" role="alert">
                Are you sure you wan't to<br><strong> DELETE <u>{{$title}}</u> Tab?</strong>
                <input type="hidden" value="{{$title}}" name="tag">
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
            <div class="modal fade" id="{{str_replace(" ","-",$title)}}edit" role="dialog">
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
                    <input type="text" class="form-control" name="new"></input>
                    <input type="hidden" name="old" value="{{$title}}"></input>
                  </div>
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
    <div class="modal fade" id="{{str_replace(" ","-",$title)}}purge" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="alert alert-warning" role="alert">
                Are you sure you wan't to<br> <strong>PURGE <u>{{$title}}</u> Tab?</strong>
                <input type="hidden" value="{{$title}}" name="tag">
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
        @foreach ($list_items as $item)
        <tr>   
                <td class="text-white">
                <button type="button" class="btn btn-danger ml-2 btn-circle btn-sm"></button>
                <button type="button" class="btn btn-warning ml-2 btn-circle btn-sm"></button></td>
             
                <td class="text-white">
                    <?php if(str_contains($item->url, "youtube.com/embed/")) : ?>
                        <iframe src={{$item->url}} width ="300px;" height="210px" 
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
} );
</script>
</div>
</table>
</div>
</div>
</div>
</div>
@endsection