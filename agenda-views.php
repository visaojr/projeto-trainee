<?php

use VisaoJR\Treinee\model\Task;
require_once 'model/Task.php';
$tarefa = new Task();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset='utf-8' />
<link href='assets/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='assets/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='assets/fullcalendar/lib/moment.min.js'></script>
<script src='assets/fullcalendar/lib/jquery.min.js'></script>
<script src='assets/fullcalendar/fullcalendar.min.js'></script>
<script src='locale/pt-br.js'></script>
<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
			},
			defaultDate: '2017-10-12',
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [	
				<?php
					$stmtTarefa = $tarefa->index();
			       	while ($row = $stmtTarefa->fetch(PDO::FETCH_OBJ)) { 
			        	?>
			        	{
			        	id: '<?php echo $row->id; ?>',
			        	title: '<?php echo $row->name; ?>',
			        	start: '<?php echo $row->date; ?>',
			        	color: '<?php echo $row->color; ?>',
			        	},<?php 
			        } 
			    ?>
				]			
		});
		
	});

</script>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

</style>
</head>
<body>

	<div id='calendar'></div>

</body>
</html>
