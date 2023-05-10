<?php 
session_start();
require ('Header.html'); 
if (!$_SESSION["displayname_th"]){
  require ('unnavbar.php');
} else {
  require ('menu.php');
}
function mixTextColor($length) {
	$colors = array('#0DA068','#194E9C','#ED9C13','#ED5713','#057249','#5F91DC','#F88E5D');
	$result = substr(str_shuffle($text), 0, $length); 
	for($i = 0; $i < $length; $i++) {
		echo $colors[array_rand($colors)];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Calendar Event</title> 
<meta charset='utf-8' />
<link href='../packages/core/main.css' rel='stylesheet' />
<link href='../packages/daygrid/main.css' rel='stylesheet' />
<link href='../packages/timegrid/main.css' rel='stylesheet' />
<link href='../packages/list/main.css' rel='stylesheet' />
<script src='../packages/core/main.js'></script>
<script src='../packages/core/locales-all.js'></script>
<script src='../packages/interaction/main.js'></script>
<script src='../packages/daygrid/main.js'></script>
<script src='../packages/timegrid/main.js'></script>
<script src='../packages/list/main.js'></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var initialLocaleCode = 'th';
    var localeSelectorEl = document.getElementById('locale-selector');
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      defaultDate: '<?php echo date('Y-m-d');?>',
      locale: initialLocaleCode,
      buttonIcons: false, // show the prev/next text
      weekNumbers: true,
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      
 eventSources: [
    // your event source
    {
      url: 'resource.php',
      method: 'POST',
      extraParams: {
        custom_param1: 'events'
      },
      failure: function() {
        alert('there was an error while fetching events!');
      },
      color: '<?php mixTextColor(1); ?>', 
      textColor: 'black' 
    }
  ]

});

    calendar.render();

    // build the locale selector's options
    calendar.getAvailableLocaleCodes().forEach(function(localeCode) {
      var optionEl = document.createElement('option');
      optionEl.value = localeCode;
      optionEl.selected = localeCode == initialLocaleCode;
      optionEl.innerText = localeCode;
      localeSelectorEl.appendChild(optionEl);
    });

    // when the selected option changes, dynamically change the calendar option
    localeSelectorEl.addEventListener('change', function() {
      if (this.value) {
        calendar.setOption('locale', this.value);
      }
    });

  });

</script>
<style>

  body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #top {
    background: #eee;
    border-bottom: 1px solid #ddd;
    padding: 0 10px;
    line-height: 40px;
    font-size: 12px;
  }

  #calendar {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 10px;
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

</style>
</head>
<body>
<script src="js/cookie.js"> </script>
  </div>  
  <div class="container-fluid">
  <div class="card">
      <div class="card-body">
      <div class=" bg-Dark text-white" role="alert">
        <h3 class="text-center" >ระบบการจองห้องประชุมออนไลน์</h3> </div>
      </div> </div> <br>
	<div class="row">
  <div id='script-warning'>
		This page should be running from a webserver, to allow fetching from the <code>json/</code> directory.
	</div>
		<div class="col-12 col-sm-12">
			<div id='calendar'></div>
		</div>
	</div>
</div>
</body>
</html>
