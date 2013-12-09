<?php include('includes/head.php') ?>

<body id="carnet" class="simple">
    <div id="wrapper">
        <header id="header" class="hidden">
            <?php 
            include('includes/headerTpl.php');
            ?> 
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

                            #carnet #welcome{
                                background-image:url('<%= data.fond %>');
                                background-position: center center; 
                                -webkit-background-size: cover;
                                -moz-background-size: cover;
                                -o-background-size: cover;
                                background-size: cover;

                                -ms-behavior: url(js/libs/backgroundsize.min.htc);
                             }

                             @media screen and (max-width: 768px){
                                #carnet #welcome{
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
                        <li class="cf dbl hidden" id="prodCol">
                             <script type="text/html" data-tpl='prodColTpl'>
                                <ul class="cf">

                                 <% _.each(data, function(item, key){ %>
                                        <li class="<%= (key == 2)? 's2':'s1' %> bloc">   

                                         <% if(key == 2 && item.cat == "placeholder"){ %>

                                                <div class="wrap figure">
                                                    <a href="http://www.louisvuitton.fr/front/#/fra_FR/Homepage">
                                                        <img alt="<%= item.title %>" src="<%= item.url %>"/>
                                                    </a>
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
                                                                <a href="<%= (!item.url)?'http://www.louisvuitton.fr/front/#/fra_FR/Collections':item.url %>" target="_blank">
                                                                    <img  alt="<%= item.title %>" src="<%= item.medias_mob[0] %>"/>
                                                                </a>
                                                                <figcaption><span><%= item.title %></span></figcaption>
                                                            </figure>
                                                    </div>
                                                    
                                                <% } %>
                                             <% }else{ %>
                                              
                                                <div class="wrap <%= (key == 0)? 'bgHaze':'pola1' %>">
                                                
                                                    <% if(key == 0){ %>
                                                        <h3 class="uppercase tt-4"><%= item.title %></h3>
                                                    <% } else { %>
                                                        <figure class="pola cf">
                                                            <a target="_blank" href="<%= (!item.url)?'http://www.louisvuitton.fr/front/#/fra_FR/Collections':item.url %>">
                                                                <img alt="<%= item.title %>" src="<%= item.medias_mob[0] %>"/>
                                                            </a>
                                                            <figcaption><span><%= item.title %></span></figcaption>
                                                        </figure>
                                                    <% } %>
                                                </div>  
                                            <% } %>
                                        </li>
                                <% }) %>

                                </ul> <!-- -->
                            </script>
                        </li>
                       
                        <li class='s3 bloc'>
                            <figure>
                                <img alt="louis vuitton" src="img/panel.png">
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
                                                    <a href="produit.php?sku=<%= item.sku %>&id=<?php echo $id ?>">
                                                    <img alt="<%= item.title %>" src="<%= item.medias[0] %>"/>
                                                    </a>
                                                </figure>
                                            </div>
                                        </li>

                            <% } else if(key>0 && key<=4) { %>
                                        <li class="s1 bloc">
                                            <div class="wrap <%= (key == 1)? 'bgHaze':'figure' %>">
                                            <% if(key == 1 ){ %>
                                                <h3 class="uppercase tt-4"><%= item.title %></h3>
                                            <% } else { %>
                                                <figure>
                                                    <a href="produit.php?sku=<%= item.sku %>&id=<?php echo $id ?>">
                                                    <img alt="louis vuitton" src="<%= item.medias[0] %>" />
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
                                            <img  alt="louis vuitton" src="<%= item.medias[0] %>"/>
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
                        <li class="cf dbl hidden" id="videoCol">
                            <script type="text/html" data-tpl='videoColTpl'>
                                <ul class="cf">

                             <% _.each(data, function(item, key){ %>

                                   <% if(key == 0){ %>
                                       <li class="s1 bloc">
                                             <div class="wrap">
                                                <figure class="play cf">
                                                    <span></span>
                                                    <img alt="louis vuitton" data-video-src="<%=item.url %>"  class="poster" src="<%= item.poster %>"/>
                                                </figure>
                                            </div>
                                        </li>
                                    <% } else if(key==1){ %>
                                         <li class='s1 bloc'>
                                            <div class="wrap bgHaze">
                                                <h3 class="uppercase tt-4"><%= item.title %></h3>
                                                
                                            </div>  
                                        </li>
                                       
                                    <% } else if( key==2 ) { %>
                                           <li class="s2 bloc">
                                             <div class="wrap">
                                                <figure class="play cf">
                                                 <span></span>
                                                    <img alt="louis vuitton" data-video-src="<%=item.url %>"  class="poster" src="<%=item.poster %>"/>
                                                </figure>
                                            </div>
                                        </li>    

                                     <% }else{ %>
                                         <li class='s1 bloc'>
                                             <div class="wrap">
                                                <figure class="play cf">
                                                 <span></span>
                                                    <img alt="louis vuitton" data-video-src="<%=item.url %>"  class="poster" src="<%=item.poster %>"/>
                                                </figure>
                                            </div> 
                                        </li>

                                    <% } %>
                                    <% }) %>
                                </ul>
                            </script>
                        </li>
                        <li class='s3 bloc'>
                            <figure>
                                <img alt="louis vuitton" src="img/panel.png">
                            </figure>
                        </li>
                    </ul>
                </div> 
            </section>
        </main>
           <?php include('includes/footer.php') ?>
    </div>

    <section class="popin">
        <div class="wrapper"></div> 
    </section>  
      

<!-- JSCALL -->
<?php include('includes/jsCall.php') ?>
</body>
</html>
