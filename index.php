<?php
	// Подключение к базе данных
	$conn = new mysqli("localhost", "root", "", "shop");
	if($conn->connect_error){
		die("Ошибка: " . $conn->connect_error);
	}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
	<!-- paste it html head -->
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css">
</head>
<body>
    <header>
        <h1>Магазин Книг</h1>
    </header>
<?php
$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['base_url'] .= "://".$_SERVER['HTTP_HOST'];
$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);?>
    <section>
        <div class="container">
            <div class="products">
			<!-- Получение списка товаров из базы данных -->
			<?php
				$sql = "SELECT * FROM products";
				if($result = $conn->query($sql)){
					foreach($result as $row){
			?>
					<div class="product">
						<div class="image">
							<img src="<?php echo $config['base_url'].$row['image']?>" alt="">
						</div>
						<div class="title"><?php echo $row['name']?></div>
						<div class="price"><?php echo $row['price']?> руб.</div>
						<form action="" class="product-form">
							<input type="hidden" name="product_id" value="<?php echo $row['id']?>">
							<input type="submit" value="Купить" class="btn">
						</form>
					</div>
			<?php
						
					}
					$result->free();
				} else{
					echo "Ошибка: " . $conn->error;
				}
				$conn->close();
			?>
            </div>
        </div>
    </section>

    <footer>
        Все права защищены
    </footer>

    <div style="display:none;">
	    <div id="order">
		    <h2>Ваш заказ</h2>
		    <div class="title"></div>
		    <form action="" class="order-form">
			    <div class="form-control count">
				    Количество
			        <input type="number" name="product_count" value="1" min="1">
			    </div>
			    <div class="form-control phone">
				    Телефон
			        <input type="text" name="phone" value="">
			    </div>
			    <input type="hidden" name="product_id" value="">
			    <input type="submit" value="Заказать" class="btn">
		    </form>
	    </div>
    </div>

    <!-- paste it in bottom of html body -->
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>
