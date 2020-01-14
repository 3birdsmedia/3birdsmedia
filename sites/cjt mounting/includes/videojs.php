function video(URL) {
    day = new Date();
    id = day.getTime();
    eval("page" + id + " = window.open(URL +'?prod_id=<?php echo $prod_id;?>', '" + id + "', 'toolbar=1,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=600,height=500,left = 440,top = 262?prod_id='+<?php echo $prod_id;?>);");
