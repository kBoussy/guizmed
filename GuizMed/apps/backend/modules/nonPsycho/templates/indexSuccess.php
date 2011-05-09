<h1>Ad non psycho pats List</h1>

<table>
  <thead>
    <tr>
      <th>Non psycho pat</th>
      <th>User patient</th>
      <th>Non psycho</th>
      <th>Start date</th>
      <th>Stop date</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ad_non_psycho_pats as $ad_non_psycho_pat): ?>
    <tr>
      <td><a href="<?php echo url_for('nonPsycho/show?non_psycho_pat_id='.$ad_non_psycho_pat->getNonPsychoPatId()) ?>"><?php echo $ad_non_psycho_pat->getNonPsychoPatId() ?></a></td>
      <td><?php echo $ad_non_psycho_pat->getPatientId() ?></td>
      <td><?php echo $ad_non_psycho_pat->getNonPsychoId() ?></td>
      <td><?php echo $ad_non_psycho_pat->getStartDate() ?></td>
      <td><?php echo $ad_non_psycho_pat->getStopDate() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('nonPsycho/new') ?>">New</a>
