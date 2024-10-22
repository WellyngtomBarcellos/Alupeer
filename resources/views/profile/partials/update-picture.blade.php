<link rel="stylesheet" href="{{asset('css/profile.css')}}?v={{ time() }}">
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Atualize sua foto do perfil") }}
        </p>
    </header>

    <form method="post" action="{{ route('updateProfile.update') }}" enctype="multipart/form-data"
        class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="Profile">
            <ion-icon class="edit" name="pencil"></ion-icon>
            <img loading="lazy" src="{{ Auth::user()->avatar }}" alt="" style="width: 150px; height: 150px; border-radius: 50%;">
        </div>
        <input type="file" id="profileImage" name="profileImage" style="display: none;">

    </form>


</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let submitting = false; // Flag to prevent recursion

    $('.Profile').on('click', function() {
        $('#profileImage').click();
    });

    $('#profileImage').on('change', function() {
        if (!submitting) {
            submitting = true;
            $(this).closest('form').submit();
        }
    });
});
</script>
