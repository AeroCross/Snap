<p><?php echo mailto($updater_email, $updater_name); ?> ha actualizado la consulta: <?php echo anchor('tickets/view/' . $ticket_id, $ticket_subject); ?></p>

<<blockquote><?php echo $message_content; ?></blockquote>

<p>Para acceder a esta consulta: <?php echo anchor('tickets/view/' . $ticket_id); ?></p>