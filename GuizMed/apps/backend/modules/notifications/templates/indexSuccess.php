<h1>Ad notifications List</h1>

<table>
  <thead>
    <tr>
      <th>Notification</th>
      <th>Prev user</th>
      <th>New user</th>
      <th>Patient</th>
      <th>Reason</th>
      <th>Accepted</th>
      <th>Checked</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ad_notifications as $ad_notification): ?>
    <tr>
      <td><a href="<?php echo url_for('notifications/show?notification_id='.$ad_notification->getNotificationId()) ?>"><?php echo $ad_notification->getNotificationId() ?></a></td>
      <td><?php echo $ad_notification->getPrevUserId() ?></td>
      <td><?php echo $ad_notification->getNewUserId() ?></td>
      <td><?php echo $ad_notification->getPatientId() ?></td>
      <td><?php echo $ad_notification->getReason() ?></td>
      <td><?php echo $ad_notification->getAccepted() ?></td>
      <td><?php echo $ad_notification->getChecked() ?></td>
      <td><?php echo $ad_notification->getDate() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('notifications/new') ?>">New</a>
