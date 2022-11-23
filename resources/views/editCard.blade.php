<x-app-layout>
    <div class="container mt-3">
        @if (Session::has('success'))
            <div class="alert alert-succes" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <form method="post" action="{{ url('update-card') }}">
            @csrf
            <input type="hidden" name='id' value='{{$data['card']->cardID}}'>
            <div class="row">
                <div class="col-6">
                    <label>Question</label>
                    <input name="question" class="form-control col-6 border" type="text" placeholder="Question" value={{$data['card']->question}}>
                </div>
                <div class="col-6">
                    <label>Answer</label>
                    <input name="answer" class="form-control col-6 border" type="text" placeholder="Answer" value={{$data['card']->answer}}>
                </div>
                <div class="col-6">
                    <label>Set</label>
                    <select class="form-control col-6 border"name="set" id="setSelect">
                        @foreach ($data["sets"] as $set)
                            <option value={{$set["name"]}}>{{$set["name"]}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn">Apply</button>
            <a href="{{ url('/create-card') }}" class="btn btn-dangerous">Back</a>
        </form>
    </div>
</x-app-layout>