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
        <div class="row mt-3 d-flex justify-content-center">
            <div class="col-4 d-flex justify-content-around">
                <button id="right-button" class="btn btn-success bg-success">
                    <span class="mt-1 material-symbols-outlined">done</span>
                </button>
                <button id="show-button" class="btn btn-secondary bg-secondary">
                    <span class="material-symbols-outlined">autorenew</span>
                </button>
                <button id="wrong-button" class="btn btn-danger bg-danger">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        const selector = document.querySelector('#setSelect');
        const cardText = document.querySelector('#card-text');
        const showButton = document.querySelector('#show-button');
        const cardLabel = document.querySelector('#card-label');
        const rightButton = document.querySelector('#right-button');
        const wrongButton = document.querySelector('#wrong-button');

        selector.addEventListener('change', (e) => getCards(e.target.value));

        function getCards(setName) {
            $.ajax({
                type: "GET",
                url: 'fetch-cards',
                data: {
                    set: setName
                },
                success: function(response) {
                    updateUI(response, 0)
                },
                error: function(err) {
                    console.log(err)
                },
                cache: false
            })
        }

        function updateUI(cards, currentIndex) {
            if (cards.length !== 0) {
                cardLabel.innerText = "Question:"
                cardText.innerText = cards[currentIndex].question
            } else {
                cardText.innerText = "Please choose a set that has (unfinished) cards"
                cardLabel.innerText = ""
            }

            rightButton.addEventListener('click', () => correctAnswer(cards, currentIndex), {
                once: true
            })
            wrongButton.addEventListener('click', () => wrongAnswer(cards, currentIndex))
            showButton.addEventListener('click', () => flipCard(cards, currentIndex))
        }

        function flipCard(cards, currentIndex) {
            if (cards.length === 0) {
                return
            }
            if (cardText.innerText === cards[currentIndex].answer) {
                cardLabel.innerText = "Question:"
                cardText.innerText = cards[currentIndex].question
            } else if (cardText.innerText === cards[currentIndex].question) {
                cardLabel.innerText = "Answer:"
                cardText.innerText = cards[currentIndex].answer
            }
        }

        function correctAnswer(cards, currentIndex) {
            incrementStep(cards[currentIndex])
            if (!cards[currentIndex + 1]) {
                cardLabel.innerText = ""
                cardText.innerText = "All Cards from Set done."
                return
            }
            updateUI(cards, currentIndex + 1)
        }

        function incrementStep(card) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{ URL::to('increment-step') }}',
                data: {
                    id: card.cardID,
                    question: card.question,
                    answer: card.answer,
                    setID: card.setID
                }
            })
        }

        function wrongAnswer(cards, currentIndex) {
            if (!cards[currentIndex + 1]) {
                cardLabel.innerText = ""
                cardText.innerText = "All Cards from Set done."
                return
            }
            updateUI(cards, currentIndex + 1)
        }
    </script>
</x-app-layout>
