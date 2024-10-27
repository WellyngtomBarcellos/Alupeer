<div id="Horizontal_container">
    <div class="lists_category">

        <a>
            <ion-icon name="game-controller-outline"></ion-icon>
            <span data-category="games">Jogos</span>
        </a>
        <a>
            <ion-icon name="wine-outline"></ion-icon>
            <span data-category="festa">Festa</span>
        </a>
        <a>
            <ion-icon name="hammer-outline"></ion-icon>
            <span data-category="service">Serviços</span>
        </a>

        <a>
            <ion-icon name="bag-outline"></ion-icon>
            <span data-category="escritorio">Escritório</span>
        </a>
        <a>
            <ion-icon name="home-outline"></ion-icon>
            <span data-category="domiciliar">Casas</span>
        </a>
        <a>
            <ion-icon name="tablet-landscape-outline"></ion-icon>
            <span data-category="outdoor">Outdoors</span>
        </a>
        <a>
            <ion-icon name="flask-outline"></ion-icon>
            <span data-category="limpeza">Limpeza</span>
        </a>
        <a>
            <ion-icon name="leaf-outline"></ion-icon>
            <span data-category="organizacao">Organização</span>
        </a>
        <a>
            <ion-icon name="accessibility-outline"></ion-icon>
            <span data-category="vestuario">Vestuário</span>
        </a>
        <a>
            <ion-icon name="american-football-outline"></ion-icon>
            <span data-category="esportes">Esportes</span>
        </a>
        <a>
            <ion-icon name="car-sport-outline"></ion-icon>
            <span data-category="automovel">Automóvel</span>
        </a>
        <a>
            <ion-icon name="videocam-outline"></ion-icon>
            <span data-category="audio_video">Audio/Video</span>
        </a>

        <a>
            <ion-icon name="camera-outline"></ion-icon>
            <span data-category="fotografia">Fotografia</span>
        </a>
        <a>
            <ion-icon name="dice-outline"></ion-icon>
            <span data-category="diversao">Diversão</span>
        </a>
        <a>
            <ion-icon name="rose-outline"></ion-icon>
            <span data-category="jardinagem">Jardinagem</span>
        </a>
        <a>
            <ion-icon name="headset-outline"></ion-icon>
            <span data-category="eletronicos">Eletronicos</span>
        </a>

    </div>
</div>

<div id="Filterlist">
    <form action="">
        <div class="container_filtragen">
            <div class="heaader">
                <ion-icon class="close_filterlist" name="close-outline"></ion-icon>
                <span class="filter_search"><ion-icon name="layers-outline"></ion-icon> Filtrar</span>
                
            </div>
            <div class="container_fil">

                <div class="slider">
                    <h2>Distância</h2>
                    <p>Procure por produtos perto ou distantes de você!</p>
                    <div class="ranger">
                        <input type="range" name="range" value="20" min="1" max="100" step="9" id="inputRange"
                            class="inputRange" />
                        <br>
                        <p>20km</p>
                    </div>
                </div>

                <div class="slider">
                    <h2>Preços</h2>
                    <p>Procure por preços desejados!</p>
                    <div class="ranger">
                        <div class="container_Pricer">
                            <p>Minimo</p>
                            <p>R$</p>
                            <input type="number" value="1" name="min_price" id="min_price">
                        </div>
                        -
                        <div class="container_Pricer">
                            <p>Máximo</p>
                            <p>R$</p>
                            <input type="number" value="980" name="max_price" id="max_price">
                        </div>
                    </div>
                </div>

                <div class="slider">
                    <h2>Categoria</h2>
                    <p>Busque em todas as categorias</p>
                    <div class="ranger category_ranger">

                        <div class="container_cate">
                            <div class="lists_category">
                                <div>
                                    <input type="checkbox" id="category-games" name="categories" value="games">
                                    <label for="category-games">
                                        <ion-icon name="game-controller-outline"></ion-icon>
                                        Jogos
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" id="category-festa" name="categories" value="festa">
                                    <label for="category-festa">
                                        <ion-icon name="wine-outline"></ion-icon>
                                        Festa
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" id="category-service" name="categories" value="service">
                                    <label for="category-service">
                                        <ion-icon name="hammer-outline"></ion-icon>
                                        Serviços
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" id="category-escritorio" name="categories"
                                        value="escritorio">
                                    <label for="category-escritorio">
                                        <ion-icon name="bag-outline"></ion-icon>
                                        Escritório
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" id="category-domiciliar" name="categories"
                                        value="domiciliar">
                                    <label for="category-domiciliar">
                                        <ion-icon name="home-outline"></ion-icon>
                                        Domiciliar
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" id="category-limpeza" name="categories" value="limpeza">
                                    <label for="category-limpeza">
                                        <ion-icon name="flask-outline"></ion-icon>
                                        Limpeza
                                    </label>
                                </div>

                                <div>
                                    <input type="checkbox" id="category-outdoor" name="categories" value="outdoor">
                                    <label for="category-outdoor">
                                        <ion-icon name="tablet-landscape-outline"></ion-icon>
                                        Outdoors
                                    </label>
                                </div>

                                <div>
                                    <input type="checkbox" id="category-organizacao" name="categories"
                                        value="organizacao">
                                    <label for="category-organizacao">
                                        <ion-icon name="leaf-outline"></ion-icon>
                                        Organização
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" id="category-vestuario" name="categories" value="vestuario">
                                    <label for="category-vestuario">
                                        <ion-icon name="accessibility-outline"></ion-icon>
                                        Vestuário
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" id="category-esportes" name="categories" value="esportes">
                                    <label for="category-esportes">
                                        <ion-icon name="american-football-outline"></ion-icon>
                                        Esportes
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" id="category-automovel" name="categories" value="automovel">
                                    <label for="category-automovel">
                                        <ion-icon name="car-sport-outline"></ion-icon>
                                        Automóvel
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" id="category-audio_video" name="categories"
                                        value="audio_video">
                                    <label for="category-audio_video">
                                        <ion-icon name="videocam-outline"></ion-icon>
                                        Audio/Video
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" id="category-fotografia" name="categories"
                                        value="fotografia">
                                    <label for="category-fotografia">
                                        <ion-icon name="camera-outline"></ion-icon>
                                        Fotografia
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" id="category-diversao" name="categories" value="diversao">
                                    <label for="category-diversao">
                                        <ion-icon name="dice-outline"></ion-icon>
                                        Diversão
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" id="category-jardinagem" name="categories"
                                        value="jardinagem">
                                    <label for="category-jardinagem">
                                        <ion-icon name="rose-outline"></ion-icon>
                                        Jardinagem
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" id="category-eletronicos" name="categories"
                                        value="eletronicos">
                                    <label for="category-eletronicos">
                                        <ion-icon name="headset-outline"></ion-icon>
                                        Eletrônicos
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </form>
</div>