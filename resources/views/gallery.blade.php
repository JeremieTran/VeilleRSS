<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Top Veille - Le site de référence de la veille informatique</title>
      <link rel="stylesheet" href="css/components.css">
      <link rel="stylesheet" href="css/icons.css">
      <link rel="stylesheet" href="css/users.css">
      <link rel="stylesheet" href="css/responsee.css">
      <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="owl-carousel/owl.theme.css">
      <!-- CUSTOM STYLE -->      
      <link rel="stylesheet" href="css/template-style.css">
      <link href="https://fonts.googleapis.com/css?family=Barlow:100,300,400,700,800&amp;subset=latin-ext" rel="stylesheet">  
      <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="js/jquery-ui.min.js"></script>  

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
                <li><a href="{{ url('/about-us') }}">A propos</a></li>
                <li><a href="{{ url('/services') }}">Services</a></li>
                <li><a href="{{ url('/gallery') }}">Utilisateurs</a></li>
            @auth
                <li><a href="{{ url('/dashboard') }}">Accueil</a></li>
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
               <div class="flex-container">
               @foreach($users as $user)
               <form action="{{ route('updateUser', ['id' => $user->id]) }}" method="post" class="user-info">
                  @csrf
                  @method('PUT')
                  <strong>ID:</strong> {{ $user->id }}<br>
                  <p><strong>Nom:</strong> 
                  <input type="text" name="name" value="{{ $user->name }}" readonly><br></p>
                  <p><strong>Email:</strong> 
                  <input type="email" name="email" value="{{ $user->email }}" readonly><br></p>
                  <!-- Ajoutez d'autres informations si nécessaire -->
                  
                  <!-- Champ caché pour l'action -->
                  <p><input type="hidden" name="action" value="edit"></p>
                  
                  <!-- Boutons Modifier et Valider -->
                  <p>
                  <button type="button" onclick="enableEdit(this)" class="btn-edit">Modifier</button>
                  <button type="submit" class="btn-submit">Valider</button>
                  <button type="submit" name="action" value="delete" class="btn-delete">Supprimer</button>
                  </p>

               </form>
               @endforeach
               </div>

            <script>
            function enableEdit(button) {
               var form = button.closest('form'); // Trouver le formulaire parent
               var inputs = form.querySelectorAll('input[type="text"], input[type="email"]');
               
               inputs.forEach(function(input) {
                  input.removeAttribute('readonly');
               });
               
               // Trouver le champ caché pour l'action et le définir sur 'edit'
               var actionInput = form.querySelector('input[name="action"]');
               if (actionInput) {
                  actionInput.value = 'edit';
               }
               
               button.style.display = 'none'; // Masquer le bouton Modifier après l'édition des champs
            }
            </script>
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