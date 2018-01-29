<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    <?php
    $php_array = $item;
    $js_array = json_encode($php_array);
    echo "var availableTags = ". $js_array . ";\n";
    ?>
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  } );
</script>