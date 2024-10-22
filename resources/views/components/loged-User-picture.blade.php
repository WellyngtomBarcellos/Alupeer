@auth
<div id="container_picture" {{$attributes}}>
    <img loading="lazy" src="{{Auth::user()->avatar}}" alt="">
</div>
@endauth
<style>
#container_picture img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: flex;
    border-radius: 100px
}
</style>
