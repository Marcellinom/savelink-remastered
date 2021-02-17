@extends('layouts/app')
@section('content')
<div class="main-body py-12">
        <div style="card bg-table">
            <div class="p-2 sm:px-20 view bg-color shadow">
            <div class="custom table-responsive text-white">


<table id="tabel" class="table table-striped table-bordered">
<thead>
        <tr>
            <th data-priority="1" width = "20%" class="text-gray-400">Title</th>
            <th data-priority="2" width = "60%" class="text-gray-400">Url</th>
            <th data-priority="3" width = "20%" class="text-gray-400">Created At</th>
         </tr>
    </thead>
    <tbody>
        @foreach ($list_items as $item)
        <tr>   
               <td class="text-white">{{$item->name}}</td>
               <td>
                    <?php if(str_contains($item->url, "youtube.com/embed/")) : ?>
                        <iframe src={{$item->url}} width ="300px;" height="210px" 
                        allowfullscreen="allowfullscreen"
                        mozallowfullscreen="mozallowfullscreen" 
                        msallowfullscreen="msallowfullscreen" 
                        oallowfullscreen="oallowfullscreen" 
                        webkitallowfullscreen="webkitallowfullscreen"></iframe>

                    <?php elseif($isTouch = isset($item->img_url)) : ?>
                            <a onclick="window.open(this.href); return false;" href = {{ $item->url }}>
                            <img src={{ $item->img_url }} alt="Image" width ="300px;" height="210px" atl="Image">
                    
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

<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"/>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.8/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap.min.css"> -->
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