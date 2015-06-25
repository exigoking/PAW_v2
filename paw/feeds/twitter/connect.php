<?php

/**
 * @file
 * Check if consumer token is set and if so send user to get a request token.
 */

/**
 * Exit with an error message if the CONSUMER_KEY or CONSUMER_SECRET is not defined.
 */
require_once('config.php');

/* Build an image link to start the redirect process. */
echo '<a href="http://127.0.0.1/twitter/redirect.php"> Authorize on Twitter </a>';