@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                @include('notify::components.notify')
                <div class="card-header">Add New Place</div>
                <div class="card-body">
                    <a href="{{ route('places.create') }}" class="btn btn-primary btn-sm float-right">Add New Place</a>
                    <table class="table table-hovered" id="tablePlace">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Place Name</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="" method="post" id="deleteForm">
    @csrf
    @method("DELETE")
    <input type="submit" value="Hapus" style="display:none">
</form>
@endsection

@push('scripts')
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" /> -->
<!-- <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script> -->
<!-- <script src="{{ asset('js/app.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script> -->
<!-- <link rel="stylesheet" href="{{asset('/vendor/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/vendor/datatables/datatables-responsive/css/responsive.bootstrap4.min.css')}}"> -->
<!-- Include jQuery -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<!-- Include DataTables CSS and JS -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css"> -->

<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script> -->
<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css"></script> -->

<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

<script src="{{asset('/vendor/datatables/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/vendor/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/vendor/datatables/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/vendor/datatables/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Include DataTables CSS dan JS -->
<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script> -->

<!-- Include DataTables Buttons extension CSS and JS -->
<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script> -->
    <script>
        // $(document).ready(function() {
        //     $.noConflict();
        //     $('#tablePlace').DataTable(); // Ganti 'yourTableId' dengan ID tabel Anda
        // });
        $(document).ready( function () {
            $('#tablePlace').DataTable();
        } );
        // $(function(){
            // let table = new DataTable('#tablePlace');
            // $.noConflict();
            // $('#tablePlace').DataTables({})
            //     processing:true,
            //     serverSide:true,
            //     ajax: '{{ route('place.data') }}',
            //     columns:[
            //         {data: 'DT_RowIndex',orderable:false,searchable:false},
            //         {data: 'place_name'},
            //         {data: 'action'}
            //     ]
            // })
        // });
    </script>
@endpush
