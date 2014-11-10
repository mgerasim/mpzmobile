<?php	
	echo "<!doctype html>";
	echo "<html";
	echo "<head>";		
	echo "<link rel=\"stylesheet\" href=\"css/bootstrap.min.css\">";
	echo "<link rel=\"stylesheet\" href=\"css/bootstrap-theme-1.css\">";
	echo "<link rel=\"stylesheet\" href=\"css/jquery.mobile.inline-png-1.4.3.min.css\">";
	echo "<link rel=\"stylesheet\" href=\"css/style.css\">";	
	echo "<script src=\"/js/bootstrap.min.js\"></script>";
	echo "<script src=\"/js/jquery.min.js\"></script>";
	echo "<script src=\"/js/show.js\"></script>";
	echo "</head>";
	echo "<body>";
	echo "<div><img alt=\"ОАО Ростелеком, Дальний Восток\" height=\"61\" src=\"images/logo-rostelecom.png\" width=\"236\" /></div>";
	echo "<div class=\"caption\">";
	echo "Список заявок";
	echo "</div>";
	
	echo "<table class=\"table table-hover table-bordered\">";
	
	$dbconn = pg_connect("host=localhost dbname=postgres user=monter password=zaq12wsx")
	or die('Could not connect: ' . pg_last_error());
	
	$result = pg_query($dbconn, "SELECT * FROM mpz.orders ORDER BY id DESC");
	if (!$result) {
	  echo "Error select from photos.\n";
	  exit;
	}
	echo "<tr>";
	echo "	<thead>";
	echo "	<th>#</th>";
	echo "	<th>Фамилия</th>";
	echo "	<th>Имя</th>";
	echo "	<th>Отчество</th>";
	echo "	<th>Телефон</th>";
	echo "	<th>Адрес</th>";
	echo "	<th>Агент</th>";	
	echo "	<th>Пакет/результат</th>";
	echo "	<th>Тариф</th>";
	echo "	<th>Комментарий</th>";
	echo "	<th>Дата</th>";
	echo "	<th>Супервайзер</th>";
	echo "	</thead>";
	echo "</tr>";
	
	echo "	<tbody>";
	while ($row = pg_fetch_row($result)) {
		echo "<tr>";
		echo "	<td>$row[0]</td>";
		echo "	<td>$row[1]</td>";
		echo "	<td>$row[2]</td>";
		echo "	<td>$row[3]</td>";
		echo "	<td>$row[4]</td>";
		echo "	<td>$row[5]</td>";
		echo "	<td>$row[6]</td>";
		echo "	<td>$row[7]</td>";
		echo "	<td>$row[8]</td>";
		echo "	<td>$row[9]</td>";
		echo "	<td>$row[10]</td>";
		echo "	<td>$row[14]</td>";
		echo "</tr>";	  
	}
	echo "	</tbody>";
	echo "</table>";
	echo "</body>";
	echo "</html>";
?>
