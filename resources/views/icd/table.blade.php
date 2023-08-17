@extends('layouts.main')

@section('container')
    <h1>Search ICD</h1>
    <div class="form-group">
        <label for="icd_code">ICD</label>
        <select class="form-control select2" name="icd_code" id="icd_code">
            <option value="" selected></option>
            @foreach($icds as $icd)
                <option value="{{ $icd->code }}">{{ $icd->name_id }}</option>
            @endforeach
        </select>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ICD Code</th>
                <th>ICD Text</th>
            </tr>
        </thead>
        <tbody id="icdTableBody">
            <!-- Table rows for fetched ICD codes will be added here -->
        </tbody>
    </table>
    <script>
        $('#icd_code').select2({
            ajax: {
                url: '/getIcd',
                type: 'GET',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                error: function(xhr, status, error) {
                    console.log(error);
                },
                cache: true
            },
            placeholder: 'Search an ICD',
            minimumInputLength: 1
        });

        function addICDCodeToTable(icdCode, icdText) {
            $('#icdTableBody').append('<tr><td>' + icdCode + '</td><td>'+icdText+'</td></tr>');
        }

        // Assuming you have an event listener for when the selection is made
        $('#icd_code').on('select2:select', function (e) {
            var icdCode = e.params.data.id;
            var icdText = e.params.data.text;
            addICDCodeToTable(icdCode, icdText);
        });
    </script>
@endsection
