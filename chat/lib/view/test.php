<html>
<header>test simple templete</header>
<body>

<tr><?php echo $title; ?></tr>
<?php foreach($person as $p):?>
<tr><td>name:<?=$p['name']?></td> <td>email:<?=$p['email']?></td> <td>age:<?=$p['age']?></td></tr>
<?php endforeach;?>
 
</body>
</html>