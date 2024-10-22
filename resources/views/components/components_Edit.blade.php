<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Link-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/site.webmanifest')}}">
    <link rel="stylesheet" href="{{asset('css/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/navbar/index.css')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{asset('css/edit/index.css')}}?v={{ time() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/5a2e7b261b.js" crossorigin="anonymous"></script>
    <title>Editando {{$item->name_item}}</title>
</head>
<body>

    <div id="container">
        <div class="side_contain">
            <h1><a class="back" href="/user/{{Auth::id()}}"><i class="fa-solid fa-chevron-left"></i></a> Editando anúncio</h1>
            <div class="conteudo_listado">
                <div class="title_div container_edit" data-target="productname">
                    <h2>Produto</h2>
                    <p class="name_item">{{$item->name_item}}</p>
                </div>
                <div class="category_div container_edit" data-target="productcategory">
                    <h2>Categoria</h2>
                    <p class="category_product">{{$item->category}}</p>
                </div>
                <div class="float_div container_edit" data-target="productflaot">
                    <h2>Desgaste</h2>
                    <p class="float_product">{{$item->float}}</p>
                </div>
                <div class="price_div container_edit" data-target="productprice">
                    <h2>Preço</h2>
                    <p class="price_product">R${{ number_format($item->price, 2, ',', '.') }} /dia</p>

                </div>
                <div class="desc_div container_edit" data-target="productdesc">
                    <h2>Descrição</h2>
                    <p class="desc_product">{{$item->descricao}}</p>
                </div>
            </div>
        </div>
        <div class="side_contain" id="edit_area">
            <i class="fa-solid fa-x" id="close_edit_container"></i>
            <div class="edit_area">
                <div id="productname" class="productname">
                    <h1>Nome do produto</h1>
                    <textarea id="textname" maxlength="50">{{$item->name_item}}</textarea>
                    <p><strong id="charCount">50</strong> caracteres restantes</p>

                </div>

                <div id="productcategory" class="productcategory">
                    <h1>Categoria do produto</h1>

                    <select name="categoria">
                        <option value="games" {{ $item->category == 'games' ? 'selected' : '' }}>Jogos</option>
                        <option value="festa" {{ $item->category == 'festa' ? 'selected' : '' }}>Festa</option>
                        <option value="service" {{ $item->category == 'service' ? 'selected' : '' }}>Serviços</option>
                        <option value="escritorio" {{ $item->category == 'escritorio' ? 'selected' : '' }}>Escritório</option>
                        <option value="domiciliar" {{ $item->category == 'domiciliar' ? 'selected' : '' }}>Casas</option>
                        <option value="outdoor" {{ $item->category == 'outdoor' ? 'selected' : '' }}>Outdoors</option>
                        <option value="limpeza" {{ $item->category == 'limpeza' ? 'selected' : '' }}>Limpeza</option>
                        <option value="organizacao" {{ $item->category == 'organizacao' ? 'selected' : '' }}>Organização</option>
                        <option value="vestuario" {{ $item->category == 'vestuario' ? 'selected' : '' }}>Vestuário</option>
                        <option value="esportes" {{ $item->category == 'esportes' ? 'selected' : '' }}>Esportes</option>
                        <option value="automovel" {{ $item->category == 'automovel' ? 'selected' : '' }}>Automóvel</option>
                        <option value="fotografia" {{ $item->category == 'fotografia' ? 'selected' : '' }}>Fotografia</option>
                        <option value="audio_video" {{ $item->category == 'audio_video' ? 'selected' : '' }}>Áudio/Video</option>
                        <option value="diversao" {{ $item->category == 'diversao' ? 'selected' : '' }}>Diversão</option>
                        <option value="jardinagem" {{ $item->category == 'jardinagem' ? 'selected' : '' }}>Jardinagem</option>
                        <option value="eletronicos" {{ $item->category == 'eletronicos' ? 'selected' : '' }}>Eletrônicos</option>
                    </select>
                </div>

                <div id="productflaot" class="productflaot">
                    <h1>Desgaste do produto</h1>

                    <select name="float">
                        <option value="Desgastado" {{ $item->float == 'Desgastado' ? 'selected' : '' }}>Desgastado</option>
                        <option value="Usado" {{ $item->float == 'Usado' ? 'selected' : '' }}>Usado</option>
                        <option value="Semi" {{ $item->float == 'Semi' ? 'selected' : '' }}>Semi</option>
                        <option value="Novo" {{ $item->float == 'Novo' ? 'selected' : '' }}>Novo</option>
                    </select>
                </div>

                <div id="productprice" class="productprice">
                    <h1>Preço do produto</h1>
                    <div class="price">
                        <span>R$</span>
                        <input name="price" type="number" value="{{ $item->price }}" />
                    </div>
                </div>

                <div id="productdesc" class="productdesc">
                    <h1>Descrição do produto</h1>
                    <textarea id="textdesc" name="descricao" maxlength="255">{{$item->descricao}}</textarea>
                    <p><strong id="descCharCount">255</strong> caracteres restantes</p>
                </div>
            </div>

            <div class="fotter_save">
                <div class="save_btn">
                    Salvar
                </div>
            </div>

        </div>
    </div>

    <script src="{{asset('js/editAnounce.js')}}?v={{ time() }}"></script>
    <script>
        var nameProd = @json($item -> name_item);
        var idProd = @json($item -> id);
        var catProd = @json($item -> category);
        var floatProd = @json($item -> float);
        var priceProd = @json($item -> price);
        var descProd = @json($item -> descricao);
        var csrfToken = '{{ csrf_token() }}'
    </script>
</body>
</html>
