<?php 
require ('navbar.php');
require ('Header.html'); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />

<link href='https://fullcalendar.io/js/fullcalendar-scheduler-1.7.1/lib/fullcalendar.min.css' rel='stylesheet' />
<link href='https://fullcalendar.io/js/fullcalendar-scheduler-1.7.1/lib/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<link href='https://fullcalendar.io/js/fullcalendar-scheduler-1.7.1/scheduler.min.css' rel='stylesheet' />

<script src='https://fullcalendar.io/js/fullcalendar-scheduler-1.7.1/lib/moment.min.js'></script>
<script src='https://fullcalendar.io/js/fullcalendar-scheduler-1.7.1/lib/jquery.min.js'></script>
<script src='https://fullcalendar.io/js/fullcalendar-scheduler-1.7.1/lib/fullcalendar.min.js'></script>
<script src='https://fullcalendar.io/js/fullcalendar-scheduler-1.7.1/scheduler.min.js'></script>

<script>

	$(function() { // document ready

		$('#calendar').fullCalendar({
			schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',//ระบุ license ว่าเราใช้งาน license ประเภทใด
			now: '<?php echo date('Y-m-d');?>',
			editable: true, // enable draggable events
			aspectRatio: 1.8,
			scrollTime: '00:00', 
			header: {
				left: 'today prev,next',
				center: 'title',
				right: 'timelineDay,timelineThreeDays,agendaWeek,month,listWeek'
			},
			defaultView: 'month',
			views: {
				timelineThreeDays: {
					type: 'timeline',
					duration: { days: 3 }
				}
			},
			resourceLabelText: 'Rooms',
			resources: [
                { id: 'A001', title: 'ห้องประชุม1', eventColor: 'green' },
				{ id: 'A002', title: 'ห้องประชุม2', eventColor: 'orange' },
                { id: 'A003', title: 'ห้องประชุม3', eventColor: 'red' },
                { 
				url: 'resource.php?resource',
				error: function() {
					$('#script-warning').show();
				}
			}],

			events: { 
				url: 'resource.php?events',
				error: function() {
					$('#script-warning').show();
				}
			}
		});
	
	});

</script>
<style>

	body {
		margin: 0;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#script-warning {
		display: none;
		background: #eee;
		border-bottom: 1px solid #ddd;
		padding: 0 10px;
		line-height: 40px;
		text-align: center;
		font-weight: bold;
		font-size: 12px;
		color: red;
	}

	#loading {
		display: none;
		position: absolute;
		top: 10px;
		right: 10px;
	}

	#calendar {
		max-width: 900px;
		margin: 50px auto;
	}

</style>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-12">
			<div id='script-warning'>
				This page should be running from a webserver, to allow fetching from the <code>json/</code> directory.</div>
			<div id='loading'>loading...</div>
			<div id='calendar'></div>
		</div>
	</div>
</div>
</body>
</html>