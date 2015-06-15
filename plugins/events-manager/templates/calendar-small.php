<?php
/*
 * This file contains the HTML generated for small calendars. You can copy this file to yourthemefolder/plugins/events-manager/templates and modify it in an upgrade-safe manner.
 *
 * There are two variables made available to you:
 *
 * 	$calendar - contains an array of information regarding the calendar and is used to generate the content
 *  $args - the arguments passed to EM_Calendar::output()
 *
 * Note that leaving the class names for the previous/next links will keep the AJAX navigation working.
 */
?>
<script type="text/javascript">
jQuery(document).ready(function() {
// Tooltip only Text
jQuery('.calendarTooltip').hover(function(){
        // Hover over code
        var title = jQuery(this).attr('title');
        jQuery(this).data('tipText', title).removeAttr('title');
        jQuery('<p class="tooltip"></p>')
        .text(title)
        .appendTo('body')
        .fadeIn('fast');
}, function() {
        // Hover out code
        jQuery(this).attr('title', jQuery(this).data('tipText'));
        jQuery('.tooltip').remove();
}).mousemove(function(e) {
        var mousex = e.pageX + -200; //Get X coordinates
        var mousey = e.pageY + 20; //Get Y coordinates
        jQuery('.tooltip')
        .css({ top: mousey, left: mousex })
	});
});
</script>
<table class="em-calendar" id="small-calendar">
	<thead>
		<tr>
			<td><a class="em-calnav em-calnav-prev" href="<?php echo $calendar['links']['previous_url']; ?>" rel="nofollow">&lt;&lt;</a></td>
			<td class="month_name" colspan="5"><?php echo ucfirst(date_i18n(get_option('dbem_small_calendar_month_format'), $calendar['month_start'])); ?></td>
			<td><a class="em-calnav em-calnav-next" href="<?php echo $calendar['links']['next_url']; ?>" rel="nofollow">&gt;&gt;</a></td>
		</tr>
	</thead>
	<tbody>
		<tr class="days-names">
			<td><?php echo implode('</td><td>',$calendar['row_headers']); ?></td>
		</tr>
		<tr>
			<?php
			$cal_count = count($calendar['cells']);
			$col_count = $count = 1; //this counts collumns in the $calendar_array['cells'] array
			$col_max = count($calendar['row_headers']); //each time this collumn number is reached, we create a new collumn, the number of cells should divide evenly by the number of row_headers
			foreach($calendar['cells'] as $date => $cell_data ){
				$class = ( !empty($cell_data['events']) && count($cell_data['events']) > 0 ) ? 'eventful':'eventless';
				if(!empty($cell_data['type'])){
					$class .= "-".$cell_data['type'];
				}
				?>
				<td class="<?php echo $class; ?>">
					<?php if( !empty($cell_data['events']) && count($cell_data['events']) > 0 ): ?>
					<a href="<?php echo esc_url($cell_data['link']); ?>" title="<?php echo esc_attr($cell_data['link_title']); ?>" class="calendarTooltip"><?php echo date('j',$cell_data['date']); ?></a>
					<?php else:?>
					<?php echo date('j',$cell_data['date']); ?>
					<?php endif; ?>
				</td>
				<?php
				//create a new row once we reach the end of a table collumn
				$col_count= ($col_count == $col_max ) ? 1 : $col_count+1;
				echo ($col_count == 1 && $count < $cal_count) ? '</tr><tr>':'';
				$count ++;
			}
			?>
		</tr>
	</tbody>
</table>