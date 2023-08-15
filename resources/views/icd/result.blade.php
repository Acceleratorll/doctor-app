    @if (empty($data['destinationEntities']) && count($data['results']) > 0)
    <p>No results found.</p>
    @else
    <h2>Search Results:</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Chapter</th>
                <th>ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['destinationEntities'] as $entity)
                <tr>
                    <td>{!! $entity['title'] !!}</td>
                    <td>{!! $entity['chapter'] !!}</td>
                    <td>{!! $entity['id'] !!}</td>
                    <td>
                        {{-- <form method="POST" action="{{ route('icd.detail',['url' => substr(strrchr($entity['id'], '/'), 1)]) }}"> --}}
                        <form method="POST" action="{{ route('icd.detail')}}">
                            @csrf
                            <input type="text" name="id" value="{{ substr(strrchr($entity['id'], '/'), 1) }}" hidden>
                            <button type="submit" class="btn btn-primary">More Details</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif