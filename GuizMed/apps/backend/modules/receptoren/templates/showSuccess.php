<table>
  <tbody>
    <tr>
      <th>Chem bonding:</th>
      <td><?php echo $med_chem_bonding->getChemBondingId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $med_chem_bonding->getName() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('receptoren/edit?chem_bonding_id='.$med_chem_bonding->getChemBondingId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('receptoren/index') ?>">List</a>
