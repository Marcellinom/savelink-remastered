
@extends('layout/main')

@section('title', 'School - Savelink')

@section('container')
<div>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

<div class="container">
<h1 class="mt-4 mb-4">School Links</h2>
    <table id="tabel" class="table table-striped table-bordered" style="width:100%; border">
    <thead>
            <tr>
                <th>Title</th>
                <th>Url</th>
                <th>Created At</th>
             </tr>
        </thead>
        <tbody>
            @foreach ($data_tables as $item)
            <tr>
                   <td>{{ $item->name }}</td>
                   <td>{{ $item->url }}</td>
                   <td>{{ $item->time }}</td>
            </tr>
           @endforeach
    </table>
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