<?php

/**
 * Reading a Blog Route - passes in a pageid, 
 * articleid, and mode
 */
$route["/blog/{page_id}/{id}/{mode}/"] = function () {
    return $render->json ($data);
};


$url = "/blog/seo-marketing/what-you-dont-know-about-seo-marekting/edit/";



var_dump(
    validate_route ($url, $route)
);



function validate_route ($url, $routes) {
    foreach ($routes as $r => $f) {
        
        # Build a pattern for the Route
        $tmp = '/' . preg_replace(
            "/{([a-zA-Z0-9\-\_\%\&\;]*)}/i", 
            "([a-zA-Z0-9\-\_\%\&\;]*)",
            str_replace('/', '\/', $r)
        ) . '$/i';
        
        # Modify pattern to extract details from URL
        $scalar_pattern = str_replace(
            "([a-zA-Z0-9\-\_\%\&\;]*)", 
            "{([a-zA-Z0-9\-\_\%\&\;]*)\}",
            $tmp
        );
        
        # Run both patterns
        $result1 = preg_match($scalar_pattern, $r, $scalars);
        $result2 = preg_match($tmp, $url, $parts);
        
        # Check that match ws ok
        if (!$result1 or !$result2)
            return false;
        
        # Build variables
        $i=0;
        foreach ($scalars as $s) {
            $data[$s] = $parts[$i];
            $i++;
        }
        return $data;
    }
}
