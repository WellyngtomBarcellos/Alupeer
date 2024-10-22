function checkNotify() {
    var status = $('.snumber_notify')
    var statusM = $('.mobline_notiifi')
    $.ajax({
        url: "/notify/verification/return",
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function (response) {
            var status_count = response.length;

            if (status_count === 0) {
                status.text('')
                statusM.text('')
                statusM.css('display', 'none')
                status.css('display', 'none')
                return
            }

            status.text(status_count)
            status.css('display', 'flex')

            var audio = document.getElementById('notification-sound');
            if (audio) {
                audio.play();
            }

        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        },
    });
}
checkNotify()
setInterval(function () {
    checkNotify()
}, 10000);
