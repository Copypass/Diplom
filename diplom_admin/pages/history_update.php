 <?php
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		session_start();
		$key_id = "";
		$name = "";
		$img = "";
		$phone = "";
		$gate = "";
		$time = "";
		$access = "";
		include("../config.php");
		$i=0;
		$alert = "";
		$section = "";
		$section_end = "";
		if(isset($_SESSION['id']))
		{
			$que = mysqli_query($db,'SELECT key_num,identificator.name,identificator.img,identificator.phone,gate.name as "gate",time,access  FROM activation_log JOIN identificator on identificator.key_num = activation_log.key_id JOIN gate on gate.gate_id= activation_log.gate_id ORDER BY time DESC LIMIT 6;');			if ( $que )
			{
				while ($row = mysqli_fetch_assoc($que))
				{
					$i++;
					$key_id = $row["key_num"];
					$name = $row["name"];
					$img = $row["img"];
					$phone = $row["phone"];
					$gate = $row["gate"];
					$time = $row["time"];
					$access = $row["access"];
					if($access)
					{
						$alert="<div class = 'alert alert-success'> Доступ разрешён</div>";
					}else
					{
						$alert="<div class = 'alert alert-error'> Доступ запрещён</div>";
					}
					if($img == "") 
						$img = "../images/null foto.png";
					if(($i%2) != 0)
					{
						$section="<div class='row-fluid'>";
						$section_end = "";
					}else
					{
						$section="";
						$section_end = "</div>";
					}
					echo $section;
					?>

																		<tr>
																			<td><?php echo $name; ?></td>
																			<td><?php echo $gate; ?></td>
																			<td>группа</td>
																			<td><?php echo $time; ?></td>
																			<td><?php echo $access; ?></td>
																		</tr>
																		
																<?php// echo $alert; ?>
							<?php
						
				}
				
			} 
		}
			
		
	?>