<!DOCTYPE html>
<title>test parallel</title>
<div>
<?php
$runtime1 = new \parallel\Runtime();
$runtime2 = new \parallel\Runtime();
$runtime3 = new \parallel\Runtime();

ob_end_flush();
ob_implicit_flush();

$runtime1->run(function() {
    while (1) {
        echo '<span class="marker">○</span> ';
        time_nanosleep(0, 100000);
    }
});

$runtime2->run(function() {
    while (1) {
        echo '<span class="marker">☓</span> ';
        time_nanosleep(0, 100000);
    }
});

$runtime3->run(function() {
    while(1) {
        echo <<<SCRIPT
        <script class="marker">
            document.querySelectorAll(".marker").forEach(e => e.parentNode.removeChild(e));
        </script>
        SCRIPT;
        time_nanosleep(0, 10000000);
    }
});

sleep(10);

$runtime1->kill();
$runtime2->kill();
$runtime3->kill();

?>
</div>
