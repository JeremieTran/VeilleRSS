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
                          <li><a href="{{ url('/index') }}">Accueil</a></li>
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
                          <li><a href="{{ url('/services') }}">Services</a></li>
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
            <h1 class="text-strong text-white text-center center text-size-60 text-uppercase margin-bottom-20">Our Services</h1>
            <p class="text-size-20 text-white text-center center text-uppercase">Con nonummy sem integer interdum volutpat dis eget eligendi aliquip dolorum magnam. Iriure duis autem vel<br> eum dolor in hendrerit in vulputate velit esse molestie consequat.</p>
          </div>
        </header>
            <form method="POST" action="{{ route('categories.storeCategory') }}">
            @csrf
            <label for="category_name">Nom de la catégorie :</label>
            <input type="text" id="category_name" name="category_name">
            <button type="submit">Créer la catégorie</button>
            </form>
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                <label for="parent_category_id">Catégorie parente :</label>
                <select id="parent_category_id" name="parent_category_id">
                    <option value="">Choisir une catégorie parente</option>
                    @foreach($parentCategories as $parentCategory)
                        <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                    @endforeach
                </select>.
                <label for="subcategory_name">Nom de la sous-catégorie :</label>
                <input type="text" id="subcategory_name" name="subcategory_name">
                <button type="submit">Créer la sous-catégorie</button>
            </form>
      </main>
      
       
      <!-- FOOTER -->
      <footer class="grid">
        <!-- Footer - top -->
        <!-- Image-->
        <div class="s-12 l-3 m-row-3 margin-bottom background-image" style="background-image:url(img/img-04.jpg)"></div>
        
        <div class="s-12 m-9 l-3 padding-2x margin-bottom background-dark">
           <h2 class="text-strong text-uppercase">Who We Are?</h2>
           <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy.</p>
        </div>
        
        <div class="s-12 m-9 l-3 padding-2x margin-bottom background-dark">
           <h2 class="text-strong text-uppercase">Where We Are?</h2>
           <img class="full-img" src="img/map.svg" alt=""/>
        </div>
        
        <div class="s-12 m-9 l-3 padding-2x margin-bottom background-dark">
           <h2 class="text-strong text-uppercase">Contact Us</h2>
           <p><b class="text-primary margin-right-10">P</b> 0800 4521 800 50</p>
           <p><b class="text-primary margin-right-10">M</b> <a class="text-primary-hover" href="mailto:contact@sampledomain.com">contact@sampledomain.com</a></p>
           <p><b class="text-primary margin-right-10">M</b> <a class="text-primary-hover" href="mailto:office@sampledomain.com">office@sampledomain.com</a></p>
        </div>
        
        <!-- Footer - bottom -->
        <div class="s-12 text-center margin-bottom">
          <p class="text-size-12">Copyright 2019, Vision Design - graphic zoo</p>
          <p class="text-size-12">All images have been purchased from Bigstock. Do not use the images in your website.</p>
          <p><a class="text-size-12 text-primary-hover" href="http://www.myresponsee.com" title="Responsee - lightweight responsive framework">Design and coding by Responsee Team</a></p>
        </div>
      </footer>                                                                    
      <script type="text/javascript" src="js/responsee.js"></script>
      <script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>
      <script type="text/javascript" src="js/template-scripts.js"></script>
      
   </body>
</html>