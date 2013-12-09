
<?php include('includes/head.php') ?>

<body id="multimedia" class="simple">
    <div id="wrapper">

        <header id="header">
           <?php include('includes/headerTpl.php') ?>

       </header> 
        <main id="main">
            <section id="welcome" class="hidden cf">

                <script type="text/html" data-tpl='welcomeTpl'>

                  <article class="welcomeBox"  >
                        <h2 class='tt iBlock'>
                            <span class="tt-welcome"><%= data.title %></span>  
                            <% if( data.stitle) {%>
                                <br/>
                               <span class="tt-welcome"><%=  data.stitle %></span>

                            <% } %>
                        </h2>
                        <% if(data.stitle) {%>
                          <div class="text cf">
                            <p> <%=  data.content %></p>
                          </div>
                          <% } %>
                    </article>

                    <style>

                         #multimedia #welcome{
                          
                            background: url('<%= data.fond %>') no-repeat scroll center center ; 
                            background-position: center center; 
                            -webkit-background-size: cover;
                            -moz-background-size: cover;
                            -o-background-size: cover;
                            background-size: cover;
                            -ms-behavior: url(js/libs/backgroundsize.min.htc);
                         }

                        @media screen and (max-width: 768px){
                          #multimedia #welcome{
                           background-image:url('<%= data.fondMobile%>')
                         }

                       }   
                    </style>
                </script>
            </section>
            
            <section id="grid" class="cf">
                 <!-- COL 1-->
                <div class="col">
                    <ul class="cf">
                        <li class="cf dbl hidden" id="multiCol1">
                             <script type="text/html" data-tpl='multiCol1Tpl'>
                                <ul class="cf">
                                    <li class='s1 bloc'>
                                        <div class="wrap bgHaze">
                                            <h3 class="uppercase tt-4"><%= data.title %></h3>
                                        </div>  
                                    </li>
                                    <% _.each(data.medias, function(item, key){ %>

                                        <li class="<%= (key == 3) ? 's2':'s1'%> bloc">
                                           <% if(item.cat == 'img'){ %>
                                            <div class="wrap figure"> 
                                                <figure class=" cf">
                                                     <a href="<%=item.url %>" class="popinImg">
                                                        <img alt="louis vuitton" src="<%=item.url %>"/>
                                                     </a>
                                                </figure>
                                            </div>

                                            <% }else{ %>
                                               <div class="wrap">
                                                <figure class="play cf">
                                                    <span></span>
                                                      <img alt="louis vuitton" data-video-src=" <%=item.url %>"  class="poster" src="<%=item.poster %>"/>
                                                   
                                                </figure>
                                            </div>
                                            <% } %>
                                        </li>
                                    <% }) %>
                                </ul> 
                            </script>
                        </li>
                        <li class='s3 bloc '>
                            <figure>
                                <img alt="louis vuitton" src="img/panel.png">
                            </figure>
                        </li>
                    </ul>
                </div>
                <!-- COL 2-->
                <div class="col"> 
                    <ul  id="multiCol2">
                      <script type="text/html" data-tpl='multiCol2Tpl'>
                        <li class="cf dbl">
    
                            <ul class="cf">
                            
                             <% _.each(data.medias, function(item, key){ %>

                                   <% if(key == 0){ %>
                                       <li class="s2 bloc">
                                         <% if(item.cat == 'img'){ %>
                                            <div class="wrap figure"> 
                                                <figure class=" cf">
                                                    <a href="<%=item.url %>" class="popinImg">
                                                        <img alt="louis vuitton" src=" <%=item.url %>"/>
                                                    </a>
                                                </figure>
                                            </div>

                                            <% }else{ %>
                                             <div class="wrap">
                                                <figure class="play cf">
                                                        <span></span>
                                                        <img alt="louis vuitton" data-video-src=" <%=item.url %>"  class="poster" src="<%=item.poster %>"/>
                                                 
                                                </figure>
                                            </div>
                                            <% } %>
                                        </li>

                                    <% } else if(key==1){ %>
                                         <li class='s1 bloc'>
                                            <div class="wrap bgHaze">
                                                <h3 class="uppercase tt-4"><%= data.title %></h3>
                                            </div>  
                                        </li>
                                         <li class="s1 bloc">
                                         <% if(item.cat == 'img'){ %>
                                            <div class="wrap figure"> 
                                                <figure class=" cf">
                                                     <a href="<%=item.url %>" class="popinImg">
                                                        <img alt="louis vuitton" src=" <%=item.url %>"/>
                                                    </a>
                                                </figure>
                                            </div>

                                            <% }else{ %>
                                             <div class="wrap">
                                                <figure class="play cf"> 
                                                     <span></span>      
                                                    <img alt="louis vuitton" data-video-src=" <%=item.url %>"  class="poster" src="<%=item.poster %>"/>
                                                </figure>
                                            </div>
                                            <% } %>
                                        </li>
                                       

                                    <% }else{ %>
                                         <li class='s1 bloc'>
                                               <% if(item.cat == 'img'){ %>
                                            <div class="wrap figure"> 
                                                <figure class=" cf">
                                                    <a href="<%=item.url %>" class="popinImg">
                                                      <img alt="louis vuitton" src=" <%=item.url %>"/>
                                                    </a>
                                                </figure>
                                            </div>

                                            <% }else{ %>
                                             <div class="wrap">
                                                <figure class="play cf">
                                                   <span></span>
                                                    <img alt="louis vuitton" data-video-src=" <%=item.url %>"  class="poster" src="<%=item.poster %>"/>
                                                </figure>
                                            </div>
                                            <% } %>
                                        </li>

                                    <% } %>
                                    <% }) %>
                                </ul>
                        </li>

                            <% _.each(data.poeme, function(item, key){ %>
                              <li class='s3 bloc'>
                                <figure>
                                    <a href="<%=item %>" class="popinImg">
                                        <img alt="louis vuitton" src="<%= item %>">
                                    </a>
                                </figure>
                             </li>

                           <% }) %>

                        </script>
                     
                    </ul>

                </div>
                 <!-- COL 3-->
                <div class="col">
                    <ul class="cf">
                        <li class="cf dbl hidden" id="multiCol3">
                             <script type="text/html" data-tpl='multiCol3Tpl'>
                                <ul class="cf">
                                    <li class='s1 bloc'>
                                        <div class="wrap bgHaze">
                                            <h3 class="uppercase tt-4"><%= data.title %></h3>
                                        </div>  
                                    </li>
                                    <% _.each(data.medias, function(item, key){ %>

                                        <li class="<%= (key == 3 || key == 4) ? 's2':'s1'%> bloc item<%= key %>">
                                           <% if(item.cat == 'img'){ %>
                                            <div class="wrap figure"> 
                                                <figure class=" cf">
                                                 <a href="<%=item.url %>" class="popinImg">
                                                    <img alt="louis vuitton" src="<%=item.url %>"/>
                                                    </a>
                                                </figure>
                                            </div>

                                            <% }else{ %>
                                               <div class="wrap">
                                                <figure class="play cf">
                                                  <span></span>
                                                  <img alt="louis vuitton" data-video-src=" <%=item.url %>"  class="poster" src="<%=item.poster %>"/>
                                                  
                                                </figure>
                                                </div>
                                            <% } %>
                                        </li>
                                    <% }) %>
                                </ul> 
                            </script>
                        </li>
                        <li class='s3 bloc '>
                            <figure>
                                <img alt="louis vuitton" src="img/panel.png">
                            </figure>
                        </li>
                    </ul>
                </div>
            </section>
        </main>
    </div>
   <?php include('includes/footer.php') ?>

<section class="popin">
    <div class="wrapper"></div> 
</section>   

<!-- JSCALL -->
<?php include('includes/jsCall.php') ?>
</body>
</html>
