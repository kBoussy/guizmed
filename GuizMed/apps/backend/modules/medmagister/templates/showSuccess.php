<table>
  <tbody>
    <tr>
      <th>Med magister form:</th>
      <td><?php echo $med_magister_form->getMedMagisterFormId() ?></td>
    </tr>
    <tr>
      <th>Naam:</th>
      <td><?php echo $med_magister_form->getNaam() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('medmagister/edit?med_magister_form_id='.$med_magister_form->getMedMagisterFormId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('medmagister/index') ?>">List</a>
