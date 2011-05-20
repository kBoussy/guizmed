<table>
  <tbody>
    <tr>
      <th>Int enzym:</th>
      <td><?php echo $int_enzym->getIntEnzymId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $int_enzym->getName() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('enzym/edit?int_enzym_id='.$int_enzym->getIntEnzymId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('enzym/index') ?>">List</a>
