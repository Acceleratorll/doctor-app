    @if (empty($data['destinationEntities']) && count($data['results']) > 0)
    <p>No results found.</p>
    @else
    <h2>Search Results:</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Chapter</th>
                <th>Action</th> <!-- Empty header for the "More Details" button column -->
            </tr>
        </thead>
        <tbody>
            @foreach ($data['destinationEntities'] as $entity)
                <tr>
                    <td>{!! $entity['title'] !!}</td>
                    <td>{!! $entity['chapter'] !!}</td>
                    <td>{!! $entity['id'] !!}</td>
                    <td>
                        <form action="post" action="{{ route('icd.detail',[urlencode($entity['id'])]) }}">
                            <input type="text" name="id" value="{{ $entity['id'] }}" hidden>
                            <button type="submit" class="btn btn-primary">More Details</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif