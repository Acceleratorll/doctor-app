<h2>Search Results:</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Definition</th>
                <th>Criteria</th>
                <th>Action</th> <!-- Empty header for the "More Details" button column -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{!! $details['title']['@value'] !!}</td>
                {{-- <td>{!! $detail['definition'] !!}</td>
                <td>{!! $detail['diagnosticCriteria'] !!}</td> --}}
                <td><a class="btn btn-primary" href="{{ $details['browserUrl'] }}">Web</a></td>
            </tr>
        </tbody>
    </table>