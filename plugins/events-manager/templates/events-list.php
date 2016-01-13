<?php
/*
 * Default Events List Template
 * This page displays a list of events, called during the em_content() if this is an events list page.
 * You can override the default display settings pages by copying this file to yourthemefolder/plugins/events-manager/templates/ and modifying it however you need.
 * You can display events however you wish, there are a few variables made available to you:
 *
 * $args - the args passed onto EM_Events::output()
 *
 */
$args = apply_filters('em_content_events_args', $args);

if( get_option('dbem_css_evlist') ) echo "<div class='css-events-list'>";

echo EM_Events::output( $args );

if( get_option('dbem_css_evlist') ) echo "</div>";


// get recurrence events
$args['recurring']=1;
$evts_recurring=EM_Events::get($args);

// get first future recurrence events
$nextRecurrences = nextRecurrences($evts_recurring);

// get non-recurrence events
$args['recurring']=0;
$evts=EM_Events::get($args);

// filter out the events that are instances of recurring events
$non_recurrence_evts = array_filter($evts,'is_no_recurrence');

// merge nextRecurrences and non-recurring events
$evts_all= array_merge($non_recurrence_evts,$nextRecurrences);
