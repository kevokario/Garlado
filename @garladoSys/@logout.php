<?php
include './Core/functions.php';
$action = 'LOG OUT';
$event = 'Successful logout from adminitstration panel.';
auditLogger($action, $event);
session_destroy();
?><script>
    document.location.href = 'index';
</script>

