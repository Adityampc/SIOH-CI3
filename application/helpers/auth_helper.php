<?php

function loggedIn()
{
    return $_SESSION['logged_in'] ?? false;
}
