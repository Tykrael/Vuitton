
<?php include('includes/head.php') ?>

<body id="voyage" class='fullScreen'>
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
        <?php include('includes/footer.php') ?>
    </div>

<!-- JSCALL -->
<?php include('includes/jsCall.php') ?>
</body>
</html>
