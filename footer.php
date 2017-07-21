        <!--footer.php begin-->
        <footer>
            <?php

            $social = [
                ['footer_facebookurl', 'fi-social-facebook'],
                ['footer_twitterurl', 'fi-social-twitter'],
                ['footer_instagramurl', 'fi-social-instagram'],
                ['footer_youtubeurl', 'fi-social-youtube'],
                ['footer_flickrurl', 'fi-social-flickr'],
                ['footer_emailurl', 'fi-mail']
            ];
            for($i = 0; $i < count($social); $i++){
                $url = get_theme_mod($social[$i][0]);
                if(strlen($url) > 0){
                    echo '<a href="' . $url . '"><i class="icon ' . $social[$i][1] . '"></i></a>';        
                }
            }

            ?>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>
