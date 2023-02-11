
<html>

<body>
<?php
if(isset($_POST['json']))
    var_dump(json_decode($_POST['json']));
?>
<form method="POST">
    <input type="text" name="json" placeholder="json"> <br>
    <button type="submit">send</button>
</form>
</body>

</html>
