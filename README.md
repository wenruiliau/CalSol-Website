Wordpress theme for a responsive + minimalist refresh of CalSol's website.


## Theme-specific setup notes:
1. Pages should be created for both the front page and the blog index, using their corresponding template files.
2. "Front Page Displays" in the admin panel's *Settings > Reading* section should be set to "A static page", with the front page and (blog) posts pages set appropriately.
3. Homepage modifications can be made in *Appearance > Customize > Static Front Page*. Images should be uploaded via Wordpress's built-in media manager.
4. Social media icons will appear when links are set in *Appearance > Customize > Footer/Social*.
5. Banner image for posts and pages (front page excluded) is determined based on a priority system:
 - "banner_image_url" custom field -- custom fields might need to be enabled under the *Screen Options* dropdown at the top of the post/page editing UI. 
 - *(Recommended)* post/page "Featured Image" dialog
 - first image in post or page
 - default theme graphic
