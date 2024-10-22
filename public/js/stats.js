/*
|--------------------------------------------------------------------------
| Atualiza o status Online/Offline
|--------------------------------------------------------------------------
|
|
|
*/
$(document).ready(function () {

    function updateActivity() {
        $.ajax({
            url: '/update-activity',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
    }

    setInterval(updateActivity, 60000);
    $(window).on('beforeunload', function () {
        updateActivity();
    });
    updateActivity();
});
