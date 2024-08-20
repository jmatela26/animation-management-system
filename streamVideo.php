<?php
include "streamClass.php";

$fileName = $_GET['page'];
$filePath = "uploads/" . $fileName;

$stream = new VideoStream($filePath);
$stream->start();
