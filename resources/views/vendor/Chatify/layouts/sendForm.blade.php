<div class="messenger-sendCard">
    <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data">
        @csrf
        <button type="button" id="send-database" class="emoji-button"><span class="fas fa-smile"></span></button>
        <textarea name="message" class="m-send app-scroll" placeholder="Digite sua mensagem"></textarea>
        <button type="button" id="send-database" class="send-button clickbtn"><span
                class="fas fa-paper-plane"></span></button>
    </form>
</div>

<script>
$(document).ready(function() {
    function sendMessage(click) {


        console.log('dentro')
        let csrfToken = "{{ csrf_token() }}";
        let message = $('.m-send').val();
        let url = window.location.href;
        let id = url.split('chatify/')[1].split('?product=')[0];
        let item = url.split('product=')[1];
        console.log(item)
        if (message !== '') {
            $('#message-form').submit();
            console.log(url, id, item)
            setTimeout(function() {
                $.ajax({
                    url: '{{ route("chatItem") }}',
                    method: 'POST',
                    data: {
                        _token: csrfToken,
                        to_id: id,
                        item: item,
                    },
                    success: function(response) {
                        console.log(response);
                        $('.m-send').val('');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    },
                    complete: function() {
                        // Optional: Code to run after the request completes, whether successful or not.
                    }
                });
            }, 500);
        }
    }

    $('button').on('click', function(event) {
        event.preventDefault();
        sendMessage();
    });

    $('.m-send').on('keypress', function(event) {
        if (event.which === 13) {
            event.preventDefault();
            sendMessage();
        }
    });
});
</script>
