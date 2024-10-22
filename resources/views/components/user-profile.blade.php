<div class="containclass">
    <div id="container_picture" {{$attributes ?? ''}}>
        <img loading="lazy" src="{{$link}}" alt="">
    </div>
    @if ($ratestatus)
    <x-user_rating class="classi" :rate="$rate"></x-user_rating>
    @endif
    @if ($stats)
    <x-online></x-online>
    @endif
</div>

<style>
.classi {
    position: absolute;
    bottom: 0px;
    left: 0;
    padding: 4px;
    width: 50px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.classi img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.containclass {
    position: relative;
}

#container_picture img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: flex;
    border-radius: 100px;
}
</style>
