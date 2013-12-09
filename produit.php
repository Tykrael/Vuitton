
<?php include('includes/head.php') ?>
<body id="product" class="fullScreen">
    <div id="wrapper">

      <header id="header" class="hidden">
         <?php include('includes/headerTpl.php') ?>
        </header>

        <main id="main">

            <!-- <div class="loader"></div> -->
            <section class="swiper-container">
                 <nav class="swiper-control">
                    <div class='product-paginate'></div>

                 </nav>       
                 <ul class="swiper-wrapper hidden">
                      <script type="text/html" data-tpl='swiperSlideTpl'>
                         <li class="swiper-slide loading">
                              <figure><img src='<%= data %>'/></figure>
                         </li>
                      </script>
                </ul>
            </section>
            <aside id="aside">
                  <article class="ct" id="swiperProdInfo"> 
                  <script type="text/html" data-tpl='swiperProdInfoTpl'>
                       <h2 class="uppercase tt-3 light-clr"><%= data.title %></h2>
                        <p><%= data.description %></p>
                     </script>
                  </article>


            </aside>
        </main>
        <?php include('includes/footer.php') ?>
    </div>
    <!-- JSCALL -->
<?php include('includes/jsCall.php') ?>

</body>
</html>
