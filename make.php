
<html>

<body>
<?php
if(isset($_POST['name']) && isset($_POST['password']))
    echo json_encode([
        'name' => $_POST['name'],
        'password' => $_POST['password'],
    ]);
?>
    <form method="POST">
        <input type="text" name="name" placeholder="name"> <br>
        <input type="password" name="password" placeholder="password"> <br>
        <button type="submit">send</button>
    </form>
</body>

</html>