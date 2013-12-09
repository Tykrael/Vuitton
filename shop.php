
<?php include('includes/head.php') ?>

<body id="shop" class='fullScreen'>
    <div id="wrapper">
       <header id="header">
          <?php include('includes/headerTpl.php') ?>
        </header> 

        <main id="main">
           <section id="welcome" class="hidden cf"  >
                  <script type="text/html" data-tpl='welcomeTpl'>
                    <article class="welcomeBox"  >
                        <h2 class='tt iBlock'>
                            <span class="tt-welcome"><%= data.title %></span>  
                            <% if(data.stitle) {%>
                               <br/>
                               <span class="tt-welcome"><%= data.stitle %></span>

                            <% } %>
                        </h2>
                          <% if(data.stitle) {%>
                            <div class="text cf">
                              <p> <%= data.text %></p>
                            </div>
                          <% }%>
                    </article>
                       <style>

                         .fullScreen #main{
                           background-image:url('<%= data.fond %>');
                             background-position: center center; 
                            -webkit-background-size: cover;
                            -moz-background-size: cover;
                            -o-background-size: cover;
                            background-size: cover;
                            -ms-behavior: url(js/libs/backgroundsize.min.htc);
                         }

                        @media screen and (max-width: 768px){
                          .fullScreen #main{
                            background-image:none
                          }
                          .fullScreen #welcome{
                           background-image:url('<%= data.fondMobile%>')
                         }

                       }
                              
                      </style>
                </script>
            </section>
      
            <aside id="aside" class="hidden info">
           
               <script type="text/html" data-tpl='infoShopTpl'>
                  <article class="ct">
                  <h2 class="uppercase tt-3 light-clr"><%= data.title %></h2>
                  <address class="italic">
                     <span class="row address"><%= data.adresse %></span>
                      <span class="row bold">Tél:<%= data.tel %></span>
                  </address>
                 
                   <ul class="shopLink">
                       <li>
                           <a href="#" class="man">mode homme</a>
                       </li>
                        <li>
                           <a href="#" class="woman">mode femme</a>
                       </li>
                        <li>
                           <a href="#" class="mShoe">chaussure</a>
                       </li>
                        <li>
                           <a href="#" class="wShoe">chaussure</a>
                       </li>
                        <li>
                           <a href="#" class="glass">lunette</a>
                       </li>
                        <li>
                           <a href="#" class="bag">sac</a>
                       </li>
                        <li>
                           <a href="#" class="jewel">bijou</a>
                       </li>
                        <li>
                           <a href="#" class="watch">montre</a>
                       </li>
                   </ul>

                   <div class='button-ct cf'>
                       <a href="#horaire" class="button fleft">horaires</a>
                        <a href="#map" class="button fright">acces</a>
                   </div>
                    <div class="acces">
                       <address id="horaire" class='push'>
                           <%= data.horaires %>
                         
                       </address>
                      <div id="map" class='push'></div>
                    </div>
                    </article>
                  </script>
                
            </aside>
        </main>
        <?php include('includes/footer.php') ?>
    </div>
<!-- JSCALL -->
<?php include('includes/jsCall.php') ?>
  <script src="https://maps.googleapis.com/maps/api/js?exp&sensor=false"></script>
</body>
</html>
