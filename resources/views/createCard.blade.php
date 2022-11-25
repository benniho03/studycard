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
                <div class="col-4">
                    <label>Question</label>
                    <input name="question" class="form-control col-6 border" type="text" placeholder="Question">
                </div>
                <div class="col-4">
                    <label>Answer</label>
                    <input name="answer" class="form-control col-6 border" type="text" placeholder="Answer">
                </div>
                {{-- Sets als Select --}}
                <div class="col-4">
                    <label>Set</label>
                    {{-- <input name="set" class="form-control col-6 border" type="text" placeholder="Set"> --}}
                    <select class="form-control"name="set" id="setSelect">
                        @foreach ($data["sets"] as $set)
                            <option value={{$set["name"]}}>{{$set["name"]}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary bg-primary">Create</button>
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data["cards"] as $entry)
                    <tr>
                        <td>{{ $entry->cardID }}</td>
                        <td>{{ $entry->question }}</td>
                        <td>{{ $entry->answer }}</td>
                        <td>{{ $entry->step }}</td>
                        <td>{{ $entry->setID }}</td>
                        <td><a class="btn btn-secondary" href="{{url('edit-card')."/".$entry->cardID}}">Edit</a><a href="{{url('delete-card')."/".$entry->cardID}}" class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>