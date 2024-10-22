<link rel="stylesheet" href="https://unpkg.com/@vectopus/atlas-icons/style.css">
<div id="Images_Selection">


    <div class="main_tittle">
        <h1>Vamos mostrar seu produto</h1>
        <p>Selecione algumas fotos para que os usuários possam analisar!</p>
    </div>
    <div class="contaner_drop">
        <div class="droparea">
            <i class="at-image"></i>
            <span>Escolha suas fotos</span>
        </div>
    </div>

    <div class="sending">
        <x-loader></x-loader>
        <p class="timing"></p>
    </div>


    <input type="file" id="file_input" multiple accept="image/*" style="display: none;">
    <div class="preview"></div>

    <div class="error">
        Eita algo errado aconteceu ☹️<br>
        Verifique todas as suas informações e tente novamente!
    </div>
</div>

<div class="contianer">
    <button id="sendDataButton"><span>Finalizar</span></button>
</div>


<script>
$(document).ready(function() {
    var droparea = $('.droparea');
    var fileInput = $('#file_input');
    var preview = $('.preview');

    droparea.on('click', function() {
        fileInput.click();
    });

    fileInput.on('change', function() {
        handleFiles(this.files);
    });

    droparea.on('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass('dragover');
    });

    droparea.on('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
    });

    droparea.on('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
        var files = e.originalEvent.dataTransfer.files;
        handleFiles(files);
    });

    function handleFiles(files) {
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (file.type.startsWith('image/')) {
                imageList.push(file);
                var reader = new FileReader();
                reader.onload = function(e) {
                    var container = $('<div>').addClass('container_img');
                    var img = $('<img>').attr('src', e.target.result).data('file', file);
                    img.on('click', function() {
                        var fileToRemove = $(this).data('file');
                        imageList = imageList.filter(f => f !== fileToRemove);
                        fileInput.val('');
                        var dataTransfer = new DataTransfer();
                        imageList.forEach(f => dataTransfer.items.add(f));
                        fileInput[0].files = dataTransfer.files;
                        container.remove();
                    });
                    container.append(img);
                    preview.append(container);
                };
                reader.readAsDataURL(file);
            }
        }
    }
});


function sendData() {

    var formData = new FormData();
    formData.append('category', category);
    formData.append('float', float);
    formData.append('name_item', product_name);
    formData.append('price', parseFloat(price)); // Assegure-se de que é um número
    formData.append('long', long);
    formData.append('description', description);
    formData.append('lat', lat);
    formData.append('token', posttoken);
    formData.append('_token', '{{ csrf_token() }}');
    // Append images to FormData
    imageList.forEach(function(file, index) {
        formData.append('images[]', file);
    });



    $('#sendDataButton').css('display', 'none')
    $('.main_tittle').css('display', 'none')
    $('.droparea').css('display', 'none')
    $('.preview').css('display', 'none')
    $('.loader').css('display', 'block')
    $('.contianer').css('display', 'flex')
    $('.error').css('display', 'none')

    $('.timing').html(
        `<span>Salvando seu anúncio</span><br>
        <span class="funny">Ajustes finais</span>`
    )


    if (!is_editing) {
        $.ajax({
            url: "{{route('anouce.create')}}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                if (response.success) {
                    setTimeout(() => {
                        window.location.href = "{{route('wellcome.done')}}";
                        $('.loader').css('display', 'none')
                    }, 4000);
                }

            },
            error: function() {

                $('#sendDataButton').css('display', 'block')
                $('#sendDataButton').text('Tentar Novamente!')

                $('.main_tittle').css('display', 'block')
                $('.error').css('display', 'flex')
                $('.droparea').css('display', 'block')
                $('.preview').css('display', 'block')
                $('.loader').css('display', 'none')
                $('.timing').css('display', 'none')


            },
            complete: function() {

            }
        });
    } else {

        $.ajax({
            url: "{{route('anouce.edit')}}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                if (response.success) {
                    setTimeout(() => {
                        window.location.href = "{{route('home')}}";
                        $('.loader').css('display', 'none')
                    }, 4000);
                }

            },
            error: function() {

                $('#sendDataButton').css('display', 'block')
                $('#sendDataButton').text('Tentar Novamente!')

                $('.main_tittle').css('display', 'block')
                $('.error').css('display', 'flex')
                $('.droparea').css('display', 'block')
                $('.preview').css('display', 'block')
                $('.loader').css('display', 'none')
                $('.timing').css('display', 'none')


            },
            complete: function() {

            }
        });












    }
}

// Exemplo de chamada da função ao clicar em um botão
$('#sendDataButton').on('click', function() {
    if (imageList.length > 0) {
        sendData();
    }
});
</script>