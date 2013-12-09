
<?php include('includes/head.php') ?>

<body id="mentions" class='fullScreen'>
    <div id="wrapper">
       <header id="header">
          <?php include('includes/headerTpl.php') ?>
        </header> 

        <main id="main">
        
            <aside id="aside" class="hidden mentions">
               <script type="text/html" data-tpl='mentionsTpl'>
                <style>

                 .fullScreen #main{
                   background-image:url('<%= data.fond %>')
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
             <article class="ct">
              <h2 class="uppercase tt-2 light-clr"><%= data.title %></h2>
              <p><%= data.text %></p>
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
