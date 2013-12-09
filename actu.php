
<?php include('includes/head.php') ?>

<body id="actu" class="fullScreen">
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
                       
                        <% if(data.text) {%>
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
            <aside id="aside">
                   <ul class="actu hidden">
                   <script type="text/html" data-tpl='newsActuTpl'>
                       <li> 
                          <h4 class="tt-4 uppercase"><%= data.title %></h4>
                          <time datetime="2013-10-16" class="italic"><%= data.date %></time>
                          <p><%= data.description %></p>
                       </li>
                    </script> 
                   </ul>
              </aside>
           </main>
        <?php include('includes/footer.php') ?>
    </div>

<!-- JSCALL -->
<?php include('includes/jsCall.php') ?>
</body>
</html>
