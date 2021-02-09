<!DOCTYPE html>
<title>test parallel</title>
<div>
<?php
$runtime1 = new \parallel\Runtime();
$runtime2 = new \parallel\Runtime();
$runtime3 = new \parallel\Runtime();

$runtime1->run(function(){
    while (1) {
        echo '<span class="marker">○</span>';
        ob_flush();
        time_nanosleep(0, 100000);
    }
});

$runtime2->run(function(){
    while (1) {
        echo '<span class="marker">☓</span>';
        ob_flush();
        time_nanosleep(0, 100000);
    }
});

$runtime3->run(function(){
    while(1) {
        echo <<<SCRIPT
        <script>
            document.querySelectorAll(".marker").forEach(e => e.parentNode.removeChild(e));
            document.currentScript.remove();
        </script>
        SCRIPT;
        ob_flush();
        time_nanosleep(0, 1000000);
    }
});

sleep(10);

$runtime1->kill();
$runtime2->kill();
$runtime3->kill();

?>
</div>
