<p><?php echo mailto($updater_email, $updater_name); ?> ha actualizado la consulta: <?php echo anchor('tickets/view/' . $ticket_id, $ticket_subject); ?></p>

<p>Para acceder a esta consulta: <?php echo anchor('tickets/view/' . $ticket_id); ?></p>