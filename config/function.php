<?php

function redirectToRoute($route){
    http_response_code(308);
    header("location: {$route}");
    exit;
}