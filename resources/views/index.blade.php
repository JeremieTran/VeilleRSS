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
          <script src="https://storage.googleapis.com/feednami-static/js/feednami-client-v1.0.1.js"></script>
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
                    text-align: center;
                }

                .rss-feed h2 {
                    margin-top: 0;
                }

                .rss-content {
                    /* Ajoutez ici le style de votre choix pour le contenu du flux RSS */
                }
                .article-title {
                    color: #fff; /* Police blanche */
                    font-size: 30; /* Taille de la police plus grosse */
                    /* Autres styles CSS selon vos besoins */
                }
                .container {
                    text-align: center; /* Centrer le contenu horizontalement */
                    margin-top: 50px; /* Espace en haut de la page */
                }

                #subcategory-select {
                    padding: 10px; /* Ajouter de l'espace autour du sélecteur */
                    font-size: 16px; /* Taille de la police */
                    border-radius: 5px; /* Coins arrondis */
                }

                .gridiv {
                    margin-top: 20px; /* Espace entre la liste déroulante et la div rss-feed */
                    text-align: left; /* Aligner le contenu de la div rss-feed à gauche */
                }

                .article {
                    margin-bottom: 20px; /* Espace entre chaque article */
                }

                .article-title {
                    margin-bottom: 10px; /* Espace entre le titre et le reste du contenu */
                    color: black; /* Texte en noir */
                    font-weight: bold; /* Texte en gras */
                    text-decoration: underline; /* Texte souligné */
                    font-size: 16px; /* Taille de la police */
                }

                .article img {
                    display: block; /* Afficher l'image en tant que bloc */
                    margin: 0 auto; /* Centrer l'image horizontalement */
                }
                .gridiv {
                    display: flex;
                    justify-content: center;
                }

                .grid-container {
                    display: grid;
                    grid-template-columns: repeat(2, minmax(0, 1fr)); /* Utiliser minmax(0, 1fr) pour permettre la réduction de la taille des colonnes */
                    gap: 20px; /* Espace entre les colonnes */
                }

                .article {
                    max-width: 100%; /* Ajuster la largeur des articles pour s'adapter aux colonnes */
                    text-align: center; /* Centrer le texte à l'intérieur des articles */
                    background-color: #cce6ff; /* Fond bleu clair */
                    color: white; /* Texte en blanc */
                    padding: 20px; /* Ajouter un espace intérieur pour améliorer la lisibilité */
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
                <h6> Le site de veille par excellence </h6>
            </a>
            @if (Route::has('login'))
            <div class="top-nav s-12 l-9">
                <ul class="top-ul right chevron">
                    <li><a href="{{ url('/') }}">Accueil</a></li>
                    <li><a href="{{ url('services') }}">Personnaliser</a></li>
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
                <!-- SECTION 1 --> 
                
          <section class="grid margin text-center">
          <a href="/" class="s-12 m-6 l-3 padding-2x vertical-center margin-bottom background-red">
            <i class="icon-sli-equalizer text-size-60 text-white center margin-bottom-15"></i>
            <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-30 text-uppercase">Actus Gaming</h3>
          </a>
          <a href="/" class="s-12 m-6 l-3 padding-2x vertical-center margin-bottom background-blue">
            <i class="icon-sli-layers text-size-60 text-white center margin-bottom-15"></i>
            <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-30 text-uppercase">Le High-Tech</h3>
          </a>
          
          <a href="/" class="s-12 m-6 l-3 padding-2x vertical-center margin-bottom background-orange">
            <i class="icon-sli-diamond text-size-60 text-white center margin-bottom-15"></i>
            <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-30 text-uppercase">Crypto, on en parle ?</h3>
          </a>
          <a href="/" class="s-12 m-6 l-3 padding-2x vertical-center margin-bottom background-aqua">
            <i class="icon-sli-share text-size-60 text-white center margin-bottom-15"></i>
            <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-30 text-uppercase">Toutes les catégories</h3>
          </a>
        </section>
        <!-- TOP SECTION -->
          <div class="container">
          <h1> Faites votre choix :  </h1>
          <h5> Si aucun choix n'apparait, veuillez tout d'abord enregister des flux en cliquant sur l'onglet "Personnaliser"  </h5>
              <select id="subcategory-select" style="background-color: #001f3f; color: white; font-family: 'Arial', sans-serif; font-weight: bold;">
                  <option value="">Sélectionnez une sous-catégorie</option>
                  @foreach ($parentCategories as $parentCategory)
                      <optgroup label="{{ $parentCategory->name }}">
                          @foreach ($parentCategory->children as $childCategory)
                              @foreach ($childCategory->flux as $flux)
                                  <option value="{{ $childCategory->id }}" data-feed-url="{{ $flux->url }}">{{ $childCategory->name }}</option>
                              @endforeach
                          @endforeach
                      </optgroup>
                  @endforeach
              </select>
              <div class="gridiv">
                  <div id="rss-feed" class="grid-container"></div>
              </div>
          </div>
        <section class="grid">
            <!-- Div où vous souhaitez afficher le flux RSS -->
        <!-- Script pour configurer et afficher le flux RSS -->
            <script>
                $(document).ready(function() {
                    $('#subcategory-select').change(function() {
                        var feedUrl = $(this).find('option:selected').data('feed-url');
                        var categoryName = $(this).find('option:selected').text(); // Récupérer le nom de la catégorie
                        $('#rss-feed').empty(); // Vide le contenu actuel du conteneur

                        if (feedUrl) {
                            // Afficher le nom de la catégorie
                            $('#category-name').text(categoryName);

                            // Récupérer le flux RSS avec Feednami
                            feednami.load(feedUrl, function(result) {
                                if (result.error) {
                                    console.log("Erreur lors de la récupération du flux RSS:", result.error);
                                } else {
                                    var entries = result.feed.entries;

                                    // Tri des entrées par date de publication (du plus récent au plus ancien)
                                    entries.sort(function(a, b) {
                                        var dateA = new Date(a.pubdate);
                                        var dateB = new Date(b.pubdate);
                                        return dateB - dateA; // Tri décroissant
                                    });

                                    // Parcourir les entrées triées du flux et les afficher dans le conteneur RSS
                                    entries.forEach(function(entry) {
                                        var articleHTML = '<div class="article">';
                                        var pubDate = new Date(entry.pubdate);
                                        var formattedDate = pubDate.toLocaleDateString('fr-FR', { day: '2-digit', month: '2-digit', year: 'numeric' });
                                        articleHTML += '<p>Date de publication: ' + formattedDate + '</p>';
                                        // Rendre le titre cliquable avec l'URL de l'article et ajouter une classe CSS spécifique
                                        articleHTML += '<h3><a class="article-title" href="' + entry.link + '" target="_blank">' + entry.title + '</a></h3>';
                                        
                                        // Vérifier s'il y a une image dans l'entrée du flux
                                        if (entry.enclosures && entry.enclosures.length > 0 && entry.enclosures[0].type.indexOf('image') !== -1) {
                                            // Afficher l'image en miniature avec une taille maximale
                                            articleHTML += '<img src="' + entry.enclosures[0].url + '" alt="Image de l\'article" style="max-width: 100px; max-height: 100px;">';
                                        }

                                        articleHTML += '</div>';
                                        $('#rss-feed').append(articleHTML);
                                    });
                                }
                            });
                        } else {
                            console.log("Aucune URL de flux RSS trouvée pour la catégorie sélectionnée.");
                        }
                    });
                });
            </script> 
        </section>     
      </main>
      
       
      <!-- FOOTER -->
      <footer class="grid">
        <!-- Footer - bottom -->
        <div class="s-12 text-center margin-bottom">
          <p class="text-size-12">Top Veille</p>
        </div>
      </footer>                                                                    
      <script type="text/javascript" src="js/responsee.js"></script>
      <script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>
      <script type="text/javascript" src="js/template-scripts.js"></script>

   </body>
</html>