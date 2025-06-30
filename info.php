<?php
if (function_exists('curl_version')) {
    echo "cURL is installed and enabled";
} else {
    echo "cURL is NOT installed";
}

?>