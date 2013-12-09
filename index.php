
<?php include('includes/head.php') ?>

<body <?php if($id == "") { ?>id="voyage" class='fullScreen'<?php } else { ?> id="home" class="simple"<?php } ?>>
    <div id="wrapper">
       <header id="header">
          <?php include('includes/headerTpl.php') ?>
        </header> 
       <?php if($id == "") { ?>
       
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
                        <div class="text cf">
                          <p> <%= data.text %></p>
                        </div>
                    </article>

                         <style>

                           .fullScreen #main{
                                background-image:url('<%= data.fond %>');

                           }

                           @media screen and (max-width: 768px){
                             #voyage.fullScreen #main{
                              background-image:none
                            }
                             #voyage.fullScreen #welcome{
                                background-image:url('<%= data.fondMobile%>')
                           }

                         }

                      </style>
                       
                </script>
            </section>

          <h3 class="ribbon ">
             <a href="odyssee.php" class='uppercase tt-4'> Decouvrir l'experience</a>
          </h3>


        </main>
        <?php } else { ?>
            <main id="main">
          
            <section id="welcome" class="hidden cf">

                <script type="text/html" data-tpl='welcomeTpl'>
                    <article class="welcomeBox"  >
                        <h2 class='tt iBlock'>
                            <span class="tt-welcome"><%= data.title %></span>  
                            <% if(data.stitle) {%>
                                <br/>
                               <span class="tt-welcome"><%= data.stitle %></span>

                            <% } %>
                        </h2>
                        <div class="text cf">
                          <p> <%= data.text %></p>
                        </div>
                    </article>

                    <style>

                         #home #welcome{
                          
                            background: url('<%= data.fond %>') no-repeat scroll center center ; 
                            background-position: center center; 
                            -webkit-background-size: cover;
                            -moz-background-size: cover;
                            -o-background-size: cover;
                            background-size: cover;
                            -ms-behavior: url(js/libs/backgroundsize.min.htc);
                         }

                        @media screen and (max-width: 768px){
                          #home #welcome{
                           background-image:url('<%= data.fondMobile%>')
                         }

                       }   
                    </style>
                </script>
            </section>
            <!-- GRID -->
            <section id="grid" class="cf">
                 <!-- COL 1-->
                <div class="col">
                    <ul class="cf">
                        <li class="cf dbl hidden" id="prodCol" >
                             <script type="text/html" data-tpl='prodColTpl'>
                                <ul class="cf">
                                     <% _.each(data, function(item, key){ %>
                                            <li class="<%= (key == 2)? 's2 placeholder':'s1' %> bloc"> 

                                            <% if(key == 0){ %>
                                                 <div class="wrap <%= (key == 0)? 'bgHaze':'pola1' %>">
                                                    <h3 class="uppercase tt-4"><a href="carnet.php?id=<?php echo $id ?>"><%= item.title %></a></h3>
                                                    <a class="link" href="carnet.php?id=<?php echo $id ?>"><%= item.title %></a>
                                                </div>
                                            <% } else if(key == 1){%> 

                                                   <% if(item.cat == "vid"){ %>
                                                       <div class="wrap">
                                                        <figure class="play cf">
                                                                <span></span>
                                                                <img alt="louis vuitton" data-video-src=" <%=item.url %>"  class="poster" src="<%=item.poster %>"/>
                                                          
                                                         </figure>
                                                        </div>

                                                    <% }else{ %> 
                                                        <div class="wrap pola1"> 
                                                            <figure class="pola cf">
                                                                <a href="<%= item.url %>" target="_blank">
                                                                    <img  alt="<%= item.title %>" src="<%= item.medias_mob[0] %>"/>
                                                                </a>
                                                                <figcaption><span><%= item.title %></span></figcaption>
                                                            </figure>
                                                    </div>
                                                    
                                                <% } %>

                                             <% }else if(key == 2){ %>  
                                                  <% if(item.cat == "placeholder"){ %>
                                                      <div class="wrap figure">
                                                         <img alt="<%= item.title %>" src="<%= item.url %>"/>
                                                        </div>  

                                                    <% }else{ %>
                                                        <div class="wrap pola1"> 
                                                            <figure class="pola cf">
                                                                <a href="<%= item.url %>" target="_blank">
                                                                    <img  alt="<%= item.title %>" src="<%= item.medias_mob[0] %>"/>
                                                                </a>
                                                                <figcaption><span><%= item.title %></span></figcaption>
                                                            </figure>
                                                        </div>
                                                    
                                                <% } %>
                                                   
                                             <% }else{ %> 
                                                         <div class="wrap pola1"> 
                                                            <figure class="pola cf">
                                                                <a href="<%= item.url %>" target="_blank">
                                                                    <img  alt="<%= item.title %>" src="<%= item.medias_mob[0] %>"/>
                                                                </a>
                                                                <figcaption><span><%= item.title %></span></figcaption>
                                                            </figure>
                                                        </div>
                                                  <% }%> 

                                            </li>
                                    <% }) %>
                                </ul> <!-- -->
                            </script>


                        </li>   
                        <li class='s3 bloc'>
                            <figure>
                                <img alt="louis vuitton" src="img/panel.jpg">
                            </figure>
                        </li>
                    </ul>
                </div>
                <!-- COL 2-->
                <div class="col hidden" id="objPatrCol">
                 <script type="text/html" data-tpl='objPatrColTpl'>
                    <ul>
                      <% _.each(data, function(item, key){ %>
                            <% if(key == 0){ %>
                                <li class="cf dbl">

                                    <ul class="cf">
                                        <li class='s2 bloc'>
                                            <div class="wrap figure">
                                                <figure>
                                                <% item %>
                                                    <a href="produit.php?sku=<%= item.sku %>&id=<?php echo $id ?>">
                                                    <img alt="<%= item.title %>" src="<%= item.medias_mob[0] %>"/>
                                                    </a>
                                                </figure>
                                            </div>
                                        </li>

                            <% } else if(key>0 && key<=4) { %>
                                        <li class="s1 bloc">
                                            <div class="wrap <%= (key == 1)? 'bgHaze':'figure' %>">
                                            <% if(key == 1 ){ %>
                                                <h3 class="uppercase tt-4"><a href="carnet.php?id=<?php echo $id ?>"><%= item.title %></a></h3>
                                                 <a class="link" href="carnet.php?id=<?php echo $id ?>"><%= item.title %></a>
                                            <% } else { %>
                                                <figure>
                                                    <a href="produit.php?sku=<%= item.sku %>&id=<?php echo $id ?>">
                                                    <img alt="louis vuitton" src="<%= item.medias_mob[0] %>" />
                                                      </a>
                                                </figure>
                                            <% } %>
                                            </div> 
                                        </li>
                                    <% if(key == 4 ) { %>
                                    </ul>
                                </li>
                            <% } %>
                            <% } else if(key>4) { %>
                                <li class="<%= (key > 4 && key < 9 )? 's3':'s1' %> bloc">
                                  <div class="wrap figure">
                                    <figure>
                                        <a href="produit.php?sku=<%= item.sku %>&id=<?php echo $id ?>">
                                            <img  alt="louis vuitton" src="<%= item.medias_mob[0] %>"/>
                                        </a>
                                    </figure>
                                    </div>
                                </li>
                            <% } %>
                        <% }) %>
                    </ul>
                    </script>
                </div>
                 <!-- COL 3-->
                <div class="col">
                    <ul>
                        <li class="cf dbl hidden" id="eventCol">
                            <script type="text/html" data-tpl='eventColTpl'>
                                <ul class="cf">
                                    <% _.each(data, function(item, key){ %>
                                        <li class="<%= (key == 4) ? 's2':'s1' %> bloc">
                                            <div class="wrap <%= (key == 0)? 'bgHaze':(key == 4)? 'pushText':'event'  %>">
                                                <% if(key == 0){ %>
                                                    <h3 class="uppercase tt-4"><a href="actu.php?id=<?php echo $id ?>"><%= item.title %></a></h3>
                                                     <a class="link" href="actu.php?id=<?php echo $id ?>"><%= item.title %></a>
                                                <% } else if(key == 4){ %>
                                                  
                                                   <p><%= item %></p>
                                                <% } else{ %>
                                                     <h4 class="tt-5 uppercase"><a href="actu.php?id=<?php echo $id ?>"><%= item.title %></a></h4>
                                                    <time datetime="2013-06-06" class="italic"><a href="actu.php?id=<?php echo $id ?>"><%= item.date %></a></time>
                                                <% } %>
                                                    </div>  
                                                </li>
                                         <% }) %>
                                </ul>
                            </script>
                        </li>
                        <li class='s3 bloc'>
                            <figure>
                                <img alt="louis vuitton" src="img/panel.jpg">
                            </figure>
                        </li>
                    </ul>
                </div>            
            </section>
        </main>
        <?php } ?>
        <?php include('includes/footer.php') ?>
    </div>

<!-- JSCALL -->
<?php include('includes/jsCall.php') ?>
</body>
</html>
