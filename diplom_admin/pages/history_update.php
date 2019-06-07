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
			$que = mysqli_query($db,'SELECT key_num,identificator.name,identificator.img,identificator.phone,gate.name as "gate",time,access  FROM activation_log JOIN identificator on identificator.key_num = activation_log.key_id JOIN gate on gate.gate_id = activation_log.gate_id ORDER BY time DESC LIMIT 6;');
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
													<div class="span6">
														<!-- block -->
														<div class="block">
															<div class="navbar navbar-inner block-header">
																<div class="muted pull-left"><?php echo $name; ?></div>
															</div>
															<div class="block-content collapse in">
															<div class="span3">
																<img alt="220x120" style="width: 120px; height: 120px;" src=<?php echo "'../$img'"; ?> >
															</div>
																<fieldset style="margin-top: 0px;">
																	<table class="table table-bordered table-striped">
																		<tr>
																			<td>Дата и время</td>
																			<td><?php echo $time; ?></td>
																		</tr>
																		<tr>
																			<td>Помещение</td>
																			<td><?php echo $gate; ?></td>
																		</tr>
																		<tr>
																			<td>идентификатор</td>
																			<td><?php echo $key_id; ?></td>
																		</tr>
																		<tr>
																			<td>Телефон:</td>
																			<td><?php echo $phone; ?></td>
																		</tr>
																	</table>
																</fieldset>
																<?php echo $alert; ?>
															</div>
														</div>
														<!-- /block -->
													</div>
												<?php echo $section_end; ?>
							<?php
						
				}
				
			} 
		}
			
		
	?>
