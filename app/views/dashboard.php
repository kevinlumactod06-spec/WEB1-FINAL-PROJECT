<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($posts)) {
    header('Location: index.php?route=newsfeed');
    exit;
}
require_once __DIR__ . '/newsfeed.php';
?>