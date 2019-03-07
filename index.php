<?php 

require_once("header.php");



// DATA HERE


for ($i = 0; $i < 3; $i++) {
    require("singleCard.php");
}
require("ads.php");
for ($i = 0; $i < 4; $i++) {
    require("singleCard.php");
}
?>
<div class="container mt-2 mb-4 text-center">
    <div class="row">
        <div class="d-none d-md-block text-center col-12 col-lg-12 col-md-12 col-sm-12">
            <img src="img/728.png" alt="728ads">
        </div>
        <div class="d-block d-md-none text-center col-12 col-lg-12 col-md-12 col-sm-12">
            <img src="img/320.png" alt="320ads">
        </div>
    </div>
</div>

<?php

require_once("footer.php");
