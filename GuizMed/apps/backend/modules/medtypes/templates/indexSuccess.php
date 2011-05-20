{
    "types": {
        "med_subtype1": [
        <?php $bol = true; ?>
        <?php foreach($med_types1 as $medsub1): ?>
        <?php if($bol==true){
            $bol=false;
        }else{
            echo',';
        } ?>
        {
            "id":"<?php echo $medsub1->getMedSubtype1Id(); ?>",
            "name":"<?php echo $medsub1->getName(); ?>"
        }
        <?php endforeach; ?>],
        "med_subtype2": [
        <?php $bol = true; ?>
        <?php foreach($med_types2 as $medsub2): ?>
        <?php if($bol==true){
            $bol=false;
        }else{
            echo',';
        } ?>
        {
            "id":"<?php echo $medsub2->getMedSubtype2Id(); ?>",
            "name":"<?php echo $medsub2->getName(); ?>"
        }
        <?php endforeach; ?>]
    }
}