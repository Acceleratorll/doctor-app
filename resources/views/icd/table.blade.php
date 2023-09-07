@extends('layouts.main')

@section('container')
    <h1>Search ICD</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ICD Code</th>
                <th>ICD Indonesia</th>
                <th>ICD English</th>
            </tr>
        </thead>
    </table>
    <script>
        $(function () {
          var table = $('.table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "/tableIcds",
              columns: [
                  {data: 'code', name: 'code'},
                  {data: 'name_id', name: 'name_id'},
                  {data: 'name_en', name: 'name_en'},
              ]
          });
          
        });
    </script>
@endsection
