<script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script>

<script>
// Global Chatify variables from PHP to JS
window.chatify = {
    name: "{{ config('chatify.name') }}",
    sounds: @json(config('chatify.sounds')),
    allowedImages: @json(config('chatify.attachments.allowed_images')),
    allowedFiles: @json(config('chatify.attachments.allowed_files')),
    pusher: @json(config('chatify.pusher')),
    pusherAuthEndpoint: '{{ route("pusher.auth") }}'
};
window.chatify.allAllowedExtensions = chatify.allowedImages.concat(chatify.allowedFiles);
</script>
<script src="{{ asset('js/chatify/utils.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/chatify/code.js') }}?v={{ time() }}"></script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script src="https://kit.fontawesome.com/5a2e7b261b.js" crossorigin="anonymous"></script>