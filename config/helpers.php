<?php

function location($location)
{
    return header('Location: ' . $location);
}

function alert($message, $location)
{
    echo "
    <script>
        alert('$message');
        window.location.href = '$location';
    </script>
    ";
}
