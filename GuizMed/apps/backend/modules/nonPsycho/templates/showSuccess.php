<table>
  <tbody>
    <tr>
      <th>Non psycho pat:</th>
      <td><?php echo $ad_non_psycho_pat->getNonPsychoPatId() ?></td>
    </tr>
    <tr>
      <th>User patient:</th>
      <td><?php echo $ad_non_psycho_pat->getUserPatientId() ?></td>
    </tr>
    <tr>
      <th>Non psycho:</th>
      <td><?php echo $ad_non_psycho_pat->getNonPsychoId() ?></td>
    </tr>
    <tr>
      <th>Start date:</th>
      <td><?php echo $ad_non_psycho_pat->getStartDate() ?></td>
    </tr>
    <tr>
      <th>Stop date:</th>
      <td><?php echo $ad_non_psycho_pat->getStopDate() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('nonPsycho/edit?non_psycho_pat_id='.$ad_non_psycho_pat->getNonPsychoPatId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('nonPsycho/index') ?>">List</a>
