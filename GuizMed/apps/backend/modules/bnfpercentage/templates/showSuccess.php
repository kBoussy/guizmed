<table>
  <tbody>
    <tr>
      <th>Bnf percentage:</th>
      <td><?php echo $med_bnf_percentage->getBnfPercentageId() ?></td>
    </tr>
    <tr>
      <th>Percentage:</th>
      <td><?php echo $med_bnf_percentage->getPercentage() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('bnfpercentage/edit?bnf_percentage_id='.$med_bnf_percentage->getBnfPercentageId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('bnfpercentage/index') ?>">List</a>
