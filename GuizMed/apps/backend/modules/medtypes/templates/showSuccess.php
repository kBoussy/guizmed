<table>
  <tbody>
    <tr>
      <th>Med type:</th>
      <td><?php echo $med_type->getMedTypeId() ?></td>
    </tr>
    <tr>
      <th>Med subtype1:</th>
      <td><?php echo $med_type->getMedSubtype1Id() ?></td>
    </tr>
    <tr>
      <th>Med subtype2:</th>
      <td><?php echo $med_type->getMedSubtype2Id() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('medtypes/edit?med_type_id='.$med_type->getMedTypeId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('medtypes/index') ?>">List</a>
