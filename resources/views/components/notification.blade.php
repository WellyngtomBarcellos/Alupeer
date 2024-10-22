<!-- Exemplo de estrutura HTML para o popup -->
<div id="error-popup">
    <span id="error-message"></span>
    <div id="progress-bar-container">
        <div id="progress-bar"></div>
    </div>
</div>

<script>
$(document).ready(function() {
    var errorMessage = @json(session('popup'));
    var openLogin = @json(session('open_login'));
    var status = @json(session('status'));

    var duration = 3000;
    var interval = 30;
    var progressBar = $('#progress-bar');
    var login = $('#Login');
    var popup = $('#error-log');


    switch (status) {
        case 'error':
            popup.css({
                'color': '#ff0000',
            });

            break;

        case 'success':
            popup.css({
                'color': '#33ff00',
            });
            break;

        case 'warning':
            popup.css({
                'color': '#ffff00',
            });
            break;

        default:
            popup.css({
                'color': '#000000',
            });
            break;
    }

    if (errorMessage && openLogin) {
        $('#error-log span').text(errorMessage);
        popup.fadeIn();
        var width = 0;
        login.css('display', 'flex');
        var progressInterval = setInterval(function() {
            width += (interval / duration) * 100;
            progressBar.css('width', width + '%');
            if (width >= 100) {
                clearInterval(progressInterval);
            }
        }, interval);
        setTimeout(function() {
            popup.fadeOut();
        }, duration);
    }
});
</script>