
@extends('layout/main')

@section('title', 'Pekob - Savelink')

@section('container')
<div>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

<div class="container">
<h1 class="mt-4 mb-4">Pekob Links</h1>
<div class="table-responsive">

    <table id="tabel" class="table table-striped table-bordered">
    <thead>
            <tr>
                <th data-priority="2" width = "20%">Title</th>
                <th data-priority="1" width = "30">Url</th>
                <th data-priority="3" width = "20%">Created At</th>
             </tr>
        </thead>
        <tbody>
            @foreach ($list_items as $item)
            <tr>
                   <td>{{ $item->name }}</td>
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
                                <img src={{ $item->img }} alt="Image" width ="300px;" height="210px" atl="Image">
                        
                        <?php else : ?>
                                <a href = {{ $item->url }}>{{ $item->url }}</a>
                        <?php endif; ?>
                   </td>
               
                   <td>{{ $item->time }}</td>
            </tr>
           @endforeach
    </table>
</div>
</div>

<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" defer></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" defer></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#tabel').DataTable();
} );
</script>
</div>
@endsection