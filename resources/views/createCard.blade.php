<x-app-layout>
    <div class="container mt-3">
        @if (Session::has('success'))
            <div class="alert alert-succes" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <form method="post" action="{{ url('create-card') }}">
            @csrf
            <div class="row">
                <div class="col-6">
                    <label>Question</label>
                    <input name="question" class="form-control col-6 border" type="text" placeholder="Question">
                </div>
                <div class="col-6">
                    <label>Answer</label>
                    <input name="answer" class="form-control col-6 border" type="text" placeholder="Answer">
                </div>
            </div>
            <button type="submit" class="btn">Create</button>
            <a href="{{ url('/') }}" class="btn btn-dangerous">Back</a>
        </form>
    </div>

    <div class="container">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>cardID</th>
                    <th>question</th>
                    <th>answer</th>
                    <th>step</th>
                    <th>setID</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $entry)
                    <tr>
                        <td>{{ $entry->cardID }}</td>
                        <td>{{ $entry->question }}</td>
                        <td>{{ $entry->answer }}</td>
                        <td>{{ $entry->step }}</td>
                        <td>{{ $entry->setID }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>