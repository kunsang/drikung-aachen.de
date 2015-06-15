#_EVENTNOTES
{has_bookings}
<h3>Bookings</h3>
#_BOOKINGFORM
{/has_bookings}

<br style="clear:both" />

<?php
if(get_field('terminanzahl'))
{
	echo '<p><strong>Anzahl der Termine:</strong> ' . get_field('terminanzahl') .' </p>';
}
?>
<p>
	<strong>Wann?</strong> - #_EVENTDATES - #_EVENTTIMES
</p>
{has_location}
<p>
	<strong>Wo?</strong> - #_LOCATIONLINK
</p>
{/has_location}
<p>

<?php

	if(get_field('bezahlung'))
	{
		echo '<p><strong>Kenntnisse: </strong> <span class="' . get_field('kenntnisse') . '"></span></p>';
		echo '<p><strong>Lehrer / ReferentInnen:</strong> <a class="ref-link" href="' . get_field('leitung') . '">' . get_field('leitung') . '</a></p>';
	}


	if(get_field('bezahlung')== "Spende")
	{
		echo '<p><strong>Gebühr - </strong> Spende</p>';
	}
	if(get_field('bezahlung')== "Eintritt")
	{
		echo '<p><strong>Eintritt - </strong> Normal: ' . get_field('eintritt') . '&euro; - ';
		echo 'Ermäßigt: ' . get_field('ermaessigt') . '&euro;</p>';
	}
	if(get_field('bezahlung')== "Gebühr")
	{
		echo '<p><strong>Gebühr - </strong> Normal: ' . get_field('gebuhr') . '&euro; - ';
		echo 'Ermäßigt: ' . get_field('ermaessigt') . '&euro;</p>';
	}

	?>

	<?php
	if(get_field('anmeldung_bis'))
	{
		echo '<p><strong>Anmeldung bis:</strong> ' . get_field('anmeldung_bis') .' </p>';
	}
	?>

<br style="clear:both" />


#_LOCATIONMAP

