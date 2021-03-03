<?php

$curLang = (get_bloginfo("language") == 'en-US') ? 'en' : 'ar';

?>
<form action="/" method="get" class="search-block js-headerSearch">
    <input type="text" name="s" id="search" class="form-control" placeholder="<?php echo ($curLang == 'en') ? 'Search' : 'بحث'; ?>" value="<?php the_search_query(); ?>" />
    <button class="btn btn-search" type="submit"><span class="icon-margnifier-simple"></span></button>
</form>