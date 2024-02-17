{{-- @dd($messages) --}}

<?php
// Data corrente
$today = new DateTime();
// Mappa dei nomi dei giorni della settimana
$dayNameArray = [
    'Mon' => 'Lun',
    'Tue' => 'Mar',
    'Wed' => 'Mer',
    'Thu' => 'Gio',
    'Fri' => 'Ven',
    'Sat' => 'Sab',
    'Sun' => 'Dom',
];

$formattedDate = '';

?>


<div class="row">
    <div class="messages col-12 order-1 col-lg-7 order-lg-0 mb-3">
        <div class="shadow">
            {{-- Controlla se ci sono messaggi --}}
            @if ($messages->isNotEmpty())
                {{-- Inizia il ciclo solo se ci sono messaggi --}}
                @forelse ($messages as $message)
                    @php
                        // Converti la stringa in un oggetto DateTime
                        $datetime = new DateTime($message->date);
                        $dayName = $dayNameArray[$datetime->format('D')];
                        // Calcola la differenza in giorni tra la data ricevuta e oggi
                        $dif = $today->diff($datetime)->days;
                        // Formattazione della data in base alla differenza
                        if ($dif <= 7) {
                            $formattedDate = $dayName . ' ' . $datetime->format('H:i');
                        } else {
                            $formattedDate = $dayName . ' ' . $datetime->format('d/m/y');
                        }
                    @endphp
                    <div class="box-email cursor-pointer" data-idMessage="{{ $message->id }}"
                        data-titleApartment="{{ $message->apartment->title }}">
                        <div class="media">
                            <div class="media-body">
                                <span class="media-meta media-meta-right">{{ $formattedDate }}</span>
                                <h4 class="text-success fw-bold">{{ $message->name }}</h4>
                                <p class="email-summary text-truncate">{{ $message->text }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Caso in cui non ci sono messaggi --}}
                    <p>Nessun messaggio disponibile al momento.</p>
                @endforelse
            @else
                {{-- Caso in cui non ci sono messaggi --}}
                <p>Nessun messaggio disponibile al momento.</p>
            @endif
        </div>
    </div>
</div>

<script>
    // Seleziona tutti gli elementi con classe 'box-email'
    const boxEmails = document.querySelectorAll('.messages .box-email');

    // Itera su tutti gli elementi e assegna un gestore di eventi al click
    boxEmails.forEach(function(boxEmail) {
        boxEmail.addEventListener('click', function() {
            boxEmails.forEach(function(boxEmail) {
                boxEmail.classList.remove('active');
            })
            boxEmail.classList.add('active');
            // array dei messaggi
            const messages = @json($messages);
            const apartmentTitle = boxEmail.getAttribute('data-titleApartment');
            console.log(apartmentTitle);
            // id messaggio cliccato
            const idMessage = boxEmail.getAttribute('data-idMessage');

            // Trova il messaggio con idMessage nell'array messages
            const selectedMessage = messages.find(function(message) {
                return message.id == idMessage;
            });

            // Adesso puoi utilizzare selectedMessage come il messaggio corrispondente
            console.log(selectedMessage);

            // Converti la stringa in un oggetto Date
            const date = new Date(selectedMessage.date);

            // Current date
            const today = new Date();

            // Calculate the difference in days between the received date and today
            const differenceInDays = Math.floor((today - date) / (1000 * 60 * 60 * 24));

            // Format the date based on the difference
            if (differenceInDays <= 7) {
                // If within a week
                formattedDate = date.toLocaleString('it-IT', {
                    weekday: 'short',
                    hour: 'numeric',
                    minute: 'numeric',
                    hour12: false
                });
            } else {
                // If more than a week away
                formattedDate = date.toLocaleString('it-IT', {
                    weekday: 'short',
                    day: '2-digit',
                    month: '2-digit',
                    year: '2-digit'
                });
            }

            // Inserisci i dati all'interno degli elementi HTML
            document.querySelector('.single-message .media-meta-right').textContent = formattedDate;
            document.querySelector('.single-message .media-meta-left').textContent = apartmentTitle;
            document.querySelector(
                    '.single-message .mt-3.mb-2.py-2.border-bottom.border-top .text-success')
                .textContent = selectedMessage.name;
            document.querySelector(
                    '.single-message .mt-3.mb-2.py-2.border-bottom.border-top span:last-child')
                .textContent = ` · ${selectedMessage.email_sender}`;
            document.querySelector('.single-message .email-summary').textContent = selectedMessage.text;


        });
    });

    // Verifica che ci siano elementi nella NodeList
    if (boxEmails.length > 0) {
        // Simula il click sul primo elemento
        boxEmails[0].click();
    }
</script>
