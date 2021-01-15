<?php
    $databse = [
        "Test nga provimi", 
        "Matematika eshte lende e mire",
        "Tung juve",
        "Progtamim ne web",
        "Gjirafa eshte e gjate",
        "software development",
        "Problem me gjet parking",
        "code editor per PHP"
    ];
?>
<html>
<head>
    <title>Search Engine</title>
</head>

<body>
    <?php 
        $q = empty($_GET['q'])?null: $_GET['q'];
    ?>
    <center>
        <img width="200" src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png" />
        <br>
        <form action="">
            <input name="q" style="width: 600px; height: 30px;" type="text">
        </form>

        <?php
        if($q != null){?>
            <div>
                <b>Ju keni kerkuar: <?php echo $q ?></b><br>
                <b>Jane gjetur N rezultate.</b>
                <ul>
                    <li>result 1</li>
                    <li>result 2</li>
                    <li>result 3</li>
                    <li>result 4</li>
                </ul>
            </div>
        <?php
        }
        ?>
    </center>
</body>

</html>