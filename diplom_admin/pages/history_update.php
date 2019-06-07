 <table class="table table-bordered">
										<thead>
                                            <tr>
                                                <th>ФИО</th>
                                                <th>Дверь</th>
                                                <th>Группа</th>
												<th>Время</th>
												<th>Доступ</th>
                                            </tr>
                                        </thead>
 <?php
		header('Access-Control-Allow-Origin: *');
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
			$que = mysqli_query($db,'SELECT key_num,identificator.name,identificator.img,identificator.phone,gate.name as "gate",time,access  FROM activation_log JOIN identificator on identificator.key_num = activation_log.key_id JOIN gate on gate.gate_id= activation_log.gate_id ORDER BY time DESC');			
			if ( $que )
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
						$alert="style = 'background-color: #dff0d8;'";
					}else
					{
						$alert="style = 'background-color: #f2dede;'";
					}
					if($img == "") 
						$img = "../images/null foto.png";
					echo $section;
					?>

																		<tr <?php echo $alert; ?>>
																			<td><?php echo $name; ?></td>
																			<td><?php echo $gate; ?></td>
																			<td>группа</td>
																			<td><?php echo $time; ?></td>
																			<td><?php echo $access; ?></td>
																		</tr>
																		
							<?php
						
				}
				
			} 
		}
			
		
	?>
	</table>