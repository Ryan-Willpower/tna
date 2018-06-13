<?php
    $absolute_path = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
    $wp_load = $absolute_path[0] . 'wp-load.php';
    require_once($wp_load);
   
    header('Content-type: text/css');
    header('Cache-control: must-revalidate');

    $url = get_attachment_url_by_title('1');
?>

body {
    background-image: url(<?php echo $url ?>);
    background-size: fill;
    background-repeat: no-repeat;
    background-position: fixed;
    color: #FFFFFF;
}

<!-- .black {
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    box-sizing: border-box;
} -->

.line {
    width: 100%;
    border-bottom: 1px solid #FFFFFF;
    margin-bottom: 3%;
}

.main {
    text-align: center;
}