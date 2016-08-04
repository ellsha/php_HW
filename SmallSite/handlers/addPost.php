<?php

$data->createRow($_POST['title'], $_POST['content']);
header("Location: ./index.php");