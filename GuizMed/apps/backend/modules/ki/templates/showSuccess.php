<table>
  <tbody>
    <tr>
      <th>Med ki val:</th>
      <td><?php echo $med_ki_val->getMedKiValId() ?></td>
    </tr>
    <tr>
      <th>Value:</th>
      <td><?php echo $med_ki_val->getValue() ?></td>
    </tr>
    <tr>
      <th>Influence:</th>
      <td><?php echo $med_ki_val->getInfluence() ?></td>
    </tr>
    <tr>
      <th>Tagval:</th>
      <td><?php echo $med_ki_val->getTagval() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('ki/edit?med_ki_val_id='.$med_ki_val->getMedKiValId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('ki/index') ?>">List</a>
