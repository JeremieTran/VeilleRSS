        <!DOCTYPE html>
        <html lang="en-US">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Top Veille - Le site de référence de la veille informatique</title>
            <link rel="stylesheet" href="css/components.css">
            <link rel="stylesheet" href="css/icons.css">
            <link rel="stylesheet" href="css/responsee.css">
            <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
            <link rel="stylesheet" href="owl-carousel/owl.theme.css">
            <!-- CUSTOM STYLE -->      
            <link rel="stylesheet" href="css/template-style.css">
            <link href="https://fonts.googleapis.com/css?family=Barlow:100,300,400,700,800&amp;subset=latin-ext" rel="stylesheet">  
            <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
            <script type="text/javascript" src="js/jquery-ui.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/FeedEk/3.2.0/js/FeedEk.min.js"></script>
            <style>
                    /* Style pour la mise en forme */
                    .gridiv {
                        display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        gap: 20px;
                    }

                    .rss-feed {
                        background-color: #f4f4f4;
                        border-radius: 10px;
                        padding: 20px;
                    }

                    .rss-feed h2 {
                        margin-top: 0;
                    }

                    .rss-content {
                        /* Ajoutez ici le style de votre choix pour le contenu du flux RSS */
                    }
                    .container {
                    text-align: center;
                    }

                    .formulaire {
                    border-radius: 5px;
                    }
                    .button {
                    background-color: #1E90FF; /* Couleur de fond */
                    border: none; /* Pas de bordure */
                    color: white; /* Couleur du texte */
                    padding: 2px 5px; /* Espacement à l'intérieur du bouton */
                    text-align: center; /* Alignement du texte */
                    text-decoration: none; /* Pas de soulignement */
                    display: inline-block; /* Affichage en ligne pour s'adapter à la taille du contenu */
                    font-size: 16px; /* Taille de la police */
                    border-radius: 5px; /* Coins arrondis */
                    cursor: pointer; /* Curseur au survol */
                    transition-duration: 0.4s; /* Durée de l'animation de transition */
                    }

                    /* Effet de survol */
                    .button:hover {
                    background-color: #45a049; /* Couleur de fond au survol */
                    }
                    footer {
                    margin-top: 60px;
                    }

                </style>  
        </head>

        <!--
            You can change the color scheme of the page. Just change the class of the <body> tag. 
            You can use this class: "primary-color-white", "primary-color-red", "primary-color-orange", "primary-color-blue", "primary-color-aqua", "primary-color-dark" 
            -->
            
            <!--
            Each element is able to have its own background or text color. Just change the class of the element.  
            You can use this class: 
            "background-white", "background-red", "background-orange", "background-blue", "background-aqua", "background-primary" 
            "text-white", "text-red", "text-orange", "text-blue", "text-aqua", "text-primary"
            -->

        <body class="size-1520 primary-color-red background-dark">
            <!-- HEADER -->
            <header class="grid">
            <!-- Top Navigation -->
            <nav class="s-12 grid background-none background-primary-hightlight">
                <!-- logo -->
                <a href="{{ url('/index') }}" class="m-12 l-3 padding-2x logo">
                    <img src="img/logo.png">
                </a>
                @if (Route::has('login'))
                <div class="top-nav s-12 l-9">
                    <ul class="top-ul right chevron">
                        <li><a href="{{ url('/') }}">Accueil</a></li>
                        <li>
                        <a href="#">Mes Catégories</a>
                            <ul>
                                @foreach($parentCategories as $parentCategory)
                                    <li>{{ $parentCategory->name }}
                                        @if($parentCategory->children->count() > 0)
                                            <ul>
                                                @foreach($parentCategory->children as $childCategory)
                                                    <li>{{ $childCategory->name }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{ route('services') }}">Personnaliser</a></li>
                        <li><a href="{{ url('/gallery') }}">Utilisateurs</a></li>
                        @auth
                        <li>
                            <a href="{{ url('/profile') }}">{{ Auth::user()->name }}</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @else
                        <li><a href="{{ route('login') }}">Connexion</a></li>
                        @if (Route::has('register'))
                        <li><a href="{{ route('register') }}">S'inscrire</a></li>
                        @endif
                        @endauth
                    </ul>
                </div>
                @endif
            </nav>
        </header>
      <!-- MAIN -->
      <main role="main">
        <!-- TOP SECTION -->
        <header class="grid">
        	<div class="s-12 padding-2x">
            <h1 class="text-strong text-white text-center center text-size-60 text-uppercase margin-bottom-20">Personnaliser mes flux</h1>
          </div>
        </header>
        <div class="container">
            <div>
                @foreach($categories as $category)
                    @foreach($category->subcategories as $subcategory)
                        <h3>{{ $subcategory->name }}</h3>
                        @if($subcategory->flux?->isNotEmpty())
                            <ul>
                                @foreach($subcategory->flux as $flux)
                                    <li>{{ $flux->url }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>Aucun flux associé à cette sous-catégorie.</p>
                        @endif
                    @endforeach
                @endforeach
            </div>


            <div class="formulaire">
                <h2>Créer une catégorie</h2>
                <form method="POST" action="{{ route('categories.storeCategory') }}">
                @csrf
                <label for="category_name">Nom de la catégorie :</label>
                <input type="text" id="category_name" name="category_name">
                <button class="button" type="submit">Créer la catégorie</button>
                </form>
            </div>
            <hr>
            <div class="formulaire">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <h2>Créer une sous-catégorie</h2>
                    <p><label for="parent_category_id">Catégorie parente :</label>
                    <select id="parent_category_id" name="parent_category_id">
                        <option value="">Choisir une catégorie parente</option>
                        @foreach($parentCategories as $parentCategory)
                            <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                        @endforeach
                    </select>.</p>
                    <br>
                    <p><label for="subcategory_name">Nom de la sous-catégorie :</label>
                    <input type="text" id="subcategory_name" name="subcategory_name">
                    <button class="button" type="submit">Créer la sous-catégorie</button></p>
                </form>
            </div>
            <hr>
            <div class="formulaire">
                <form method="POST" action="{{ route('rss.store') }}">
                    @csrf
                    <h2>Créer un flux RSS</h2>
                    <p><label for="category_id">Sous-catégorie :</label>
                    <select id="category_id" name="category_id">
                        <option value="">Choisir une sous-catégorie</option>
                        @foreach($categories as $category)
                                @foreach($category->subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                        @endforeach
                    </select></p>
                    <br>
                    <p><label for="rss_url">URL du flux RSS :</label>
                    <input type="text" id="rss_url" name="rss_url">
                    <button class="button" type="submit">Créer le flux RSS</button></p>
                </form>
            </div>
        </div>
      </main>

              <!-- Footer  -->
      <footer>
        <div class="s-12 text-center margin-bottom">
          <p class="text-size-12">Veille RSS</p>
          <p class="text-size-12">Le site de veille de référence.</p>
          <p><a class="text-size-12 text-primary-hover" href="http://www.myresponsee.com" title="Responsee - lightweight responsive framework"></a></p>
        </div>
      </footer>
                                                                         
      <script type="text/javascript" src="js/responsee.js"></script>
      <script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>
      <script type="text/javascript" src="js/template-scripts.js"></script>
      
   </body>
</html>