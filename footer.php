


<footer  class="footer-site px-5">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-11 col-sm-11">
				<div class="footer-left" >
					<p>Desenvolvido com <span class="coracao-footer">❤</span> por <a target="_blank" href="http://www.visaojr.com.br/">Visão Tecnologia e Sistemas.</a></p>
				</div>
			</div>
			<div class="col-md-1 col-sm-1">

				<a class="text-center visao-logo-footer" href="http://www.visaojr.com.br/" title="Acessar o site da Visão" target="_blank"><img src="assets/images/visao-logo-footer.png"/></a>

			</div>
		</div>
	</div>
</footer>







<!-- /#page-content-wrapper -->



</div>


<!-- /#wrapper -->


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src='assets/fullcalendar/lib/moment.min.js'></script>
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
<!-- Script para fazer com que o botão esconda a barra lateral -->
<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>



</body>

</html>