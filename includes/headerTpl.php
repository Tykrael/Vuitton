
<script type="text/html" data-tpl='headerTpl'>
            <h1 class="logo"><a href="voyage.php"><img alt="louis vuitton" src="img/logo.png"></a></h1>
            <h2 class="tt-3 uppercase light-clr iBlock vMid"><%= data.title %></h2>
            
            <a href="#" class="lang">english</a>
            <a class="navDisplay" href="#">Menu</a> 

            <nav id="nav">
                <ul class="nav clear">
                   <% _.each(data.menu, function(item, key){ %>
                     <li><a href="<%= item.slug %>.php" data-nav="<%= item.slug %>"><%= item.title %></a></li>
                    <%})%>
                
                </ul>
            </nav>
</script>

