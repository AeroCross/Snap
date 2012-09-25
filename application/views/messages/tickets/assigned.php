<p><?php echo mailto($assigner_email, $assigner_name); ?> le ha asignado una consulta: <?php echo anchor('tickets/view/' . $ticket_id, $ticket_subject); ?></p>

<blockquote><?php echo $ticket_content; ?></blockquote>

<p>Para acceder a esta consulta: <?php echo anchor('tickets/view/' . $ticket_id); ?></p>