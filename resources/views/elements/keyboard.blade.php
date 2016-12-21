<link href="css/base/jquery-ui-1.9.2.custom.css" rel="stylesheet">
<script src="js/jquery-1.8.3.js"></script>
<script src="js/jquery-ui-1.9.2.custom.js"></script>

<script type='text/javascript'>
var lastelement = 0;
var letter = 0;

$(document).ready(function() {
$('#keyboard_element button').click(function (event) {
	console.log('knop');	
	//ahaa!!! een knopje van het toetsenbord! even bedenken welke letter ook alweer.
	letter = $(this).attr('id');
    
	switch(letter) {
		case "wis":
			//het element dat zijn focus is verloren moet leeg.
			lastelement.get(0).value = '';
			break;

		case "bs":
			//het element dat zijn focus is verloren moet een letter af
			lastelement.get(0).value = lastelement.get(0).value.slice(0,-1);
			break;

		default:
			//het element dat zijn focus is verloren moet er een letter bij.
			setTimeout(function () { lastelement.get(0).value+=letter; }, 10);
	} 
});
});

$('input').focus(function (event) {
	//welk focussen we nu op?
	lastelement = $(this);
	lastelement.blur();
	console.log('focus');
	$('#keyboard_dialog').dialog({
        	resizable: false,
		title: 'Toetsenbord',
        	width:'auto'
	});
});
</script>

<div id='keyboard_dialog' style='display:none;'>
<div id='keyboard_element' align='center'>
        <button id='1'>1</button>
        <button id='2'>2</button>
        <button id='3'>3</button>
        <button id='4'>4</button>
        <button id='5'>5</button>
        <button id='6'>6</button>
        <button id='7'>7</button>
        <button id='8'>8</button>
        <button id='9'>9</button>
        <button id='0'>0</button>
        <button id='bs'><<<</button><br />

        <button id='q'>q</button>
        <button id='w'>w</button>
        <button id='e'>e</button>
        <button id='r'>r</button>
        <button id='t'>t</button>
        <button id='y'>y</button>
        <button id='u'>u</button>
        <button id='i'>i</button>
        <button id='o'>o</button>
        <button id='p'>p</button><br />
        <button id='a'>a</button>
        <button id='s'>s</button>
        <button id='d'>d</button>
        <button id='f'>f</button>
        <button id='g'>g</button>
        <button id='h'>h</button>
        <button id='j'>j</button>
        <button id='k'>k</button>
        <button id='l'>l</button><br />
        
        <button id='z'>z</button>
        <button id='x'>x</button>
        <button id='c'>c</button>
        <button id='v'>v</button>
        <button id='b'>b</button>
        <button id='n'>n</button>
        <button id='m'>m</button><br />

        <button id='wis'>wis invoer</button>
        <button id=' '>spatie</button>
</div>
</div>
