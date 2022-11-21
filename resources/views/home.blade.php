<x-app-layout>
    <div class="container d-flex flex-column justify-content-center" style="min-height: 70vh">
        <div class="row mt-3">
            <div class="col d-flex justify-content-center">
                <h1 class="h1">Studycard</h1>
            </div>
        </div>

        <form class="container col-4 my-3">
            <label for="setSelect">Set</label>
            <select class="form-control" name="set" id="setSelect">
                <option value="" selected disabled hidden>Choose here</option>
                @foreach ($data['sets'] as $set)
                    <option value={{ $set['name'] }}>{{ $set['name'] }}</option>
                @endforeach
            </select>
        </form>
        <div class="row d-flex justify-content-center">
            <div class="col-8 card-container d-grid place-items-center border border-3 border-dark p-5">
                <span id="card-label"></span>
                <p class="fs-3 text-center" id="card-text">Choose a set of your cards!</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4 d-flex justify-content-end">
                <button id="right-button" class="btn btn-success">We lit</button>
            </div>
            <div class="col-4 d-flex justify-content-center">
                <button id="show-button" class="btn btn-secondary">Check</button>
            </div>
            <div class="col-4 d-flex justify-content-start">
                <button id="wrong-button" class="btn btn-danger">Big L</button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        const selector = document.querySelector('#setSelect');
        const cardText = document.querySelector('#card-text');
        const showButton = document.querySelector('#show-button');
        const cardLabel = document.querySelector('#card-label')

        selector.addEventListener('change', (e) => {
            getCards(e.target.value);
        })

        function appLogic(cards) {
            showButton.addEventListener('click', function() {
                flipCard(cards)
            })
        }

        function getCards(value) {
            $.ajax({
                type: "GET",
                url: 'fetch-cards',
                data: {
                    set: value
                },
                success: function(response) {
                    updateUI(response.cards)
                    appLogic(response.cards)
                },
                error: function(err){
                    console.log(err)
                }
            })
        }

        function updateUI(cards) {
            if (cards.length !== 0) {
                cardLabel.innerText = "Question:"
                cardText.innerText = cards[0].question
            } else {
                cardText.innerText = "Please choose a set that has cards"
                cardLabel.innerText = ""
            }
        }

        function flipCard(cards) {

            if (cards.length === 0) {
                console.log('Cards ist leer', cards)
            }
            if (cardText.innerText === cards[0].answer) {
                cardLabel.innerText = "Question:"
                cardText.innerText = cards[0].question
            } else if(cardText.innerText === cards[0].question){
                cardLabel.innerText = "Answer:"
                cardText.innerText = cards[0].answer
            }
        }
    </script>
</x-app-layout>
