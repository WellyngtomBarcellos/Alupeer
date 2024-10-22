<div class="card_item">
    <div class="img">
        @auth
        @if ($item->users->id === Auth::User()->id)
        <div class="options btn_misc">
            <span>
                <i class="fa-solid fa-ellipsis"></i>
            </span>
        </div>
        @endif
        @endauth
        <img loading="lazy" src="{{$item->images->first()->link}}" alt="Item Image">
    </div>

    <div style="cursor:pointer" class="link">
        <a href="/produto/{{$item->token}}">
            <span>{{$item->name_item}}</span>
            <span>{{$item->float}}</span>
            <span>R${{$item->price}}</span>
        </a>
    </div>

    <div class="option" data-item="option_{{$item->token}}">

        <li onclick="shareLink('{{$item->token}}')"><i class="fa-solid fa-share"></i> <span>Compartilhar link</span>
        </li>
        <hr>
        <li onclick="deleteAnounce('{{$item->token}}')"><i class="fa-solid fa-eraser"></i> <span>Eliminar Anuncio</span>
        </li>
        <hr>
        <li onclick="editAnounce('{{$item->token}}')"><i class="fa-solid fa-pen-to-square"></i> <span>Editar
                Anuncio</span></li>
    </div>
</div>
