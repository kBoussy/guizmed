<?php

/**
 * AdPatient
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    GuizMed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class AdPatient extends BaseAdPatient
{
public function berekenBNF()
        {
        $patient_id = $this->getPatientId();
         $bnfWaarde = 0;
        /** $patient_id = 1;**/
        /** selectie van alle voorschriften per patient met patient_id * */
        $allAdUsers = Doctrine_Query::create()->from('adUserPatient aup')->where('aup.patient_id = ?',$patient_id)->execute();
        foreach($allAdUsers as $adUserken){
        $p = Doctrine_Query::create()
        ->from('AdPrescription a')
        ->where('a.user_patient_id = ?', $adUserken->getUserPatientId())
        ->execute();

        foreach($p as $prec): /**elk voorschrift overlopen per patient**/

            $m = $prec->getMedFormId();
            $ed = $prec->getEndDate();
            $f = $prec->getMedForm();
            $sd = $prec->getStopDate();
            $dos = $prec->getDose();

            $h = $f->getHlf();
             /**echo $dos;**/
            $t = Doctrine_Query::create()
                ->from('MedBnfMedicine b')
                ->where('b.med_form_id = ?', $m)
                ->execute();


                     foreach ($t as $bnf):                                      /** voor elke medform van de prescription het bnf opzoeken**/
                                $s = $bnf->getMedBnfPercentage();

                                $v = $s->getPercentage();
                                $val = $bnf->getValue();
                                $val2 = explode(".", $val);

                          if ($dos == $val2[0]){
                                        if ($sd != null){                       /**1ste voorwaarde = geen stopdatum ingevuld**/

                                        $bnfVal = 0;

                                        $today = date("Y-m-d H:i:s");
                                        $sd = $prec->getStopDate();

                                        $h = $f->getHlf();

                                                                            if (preg_match("/d/i", $h)) {   /** in de juiste vorm gieten van hlf om bij de einddatum te tellen**/


                                                                            $hlf = explode(" ", $h); /** indien met spatie **/
                                                                            $days = 5 * $hlf[0];

                                                                            $m = floor ($days / 30);
                                                                            $d = floor ($days - $m * 30);
                                                                                                              /** echo 'plus'. $m .'maanden en '. $d .'dagen is :';**/

                                                                            $ST = new DateTime($sd);

                                                                             date_add($ST, new DateInterval('P'. $m .'M'. $d .'D'));
                                                                             $sd = $ST;

                                                                            } else {

                                                                                    if (preg_match("/-/i", $h)) { /** indien met koppelteken **/

                                                                                        $hlf = explode("-", $h);
                                                                                        $hours = 5 * $hlf[1];

                                                                                        $d = floor ($hours / 24);
                                                                                        $hr = floor ($hours - $d * 24);
                                                                                                                    /**echo 'plus'. $d .'dagen en '. $hr .'uren is :';**/
                                                                                        $ST = new DateTime($sd);
                                                                                        date_add($ST, new DateInterval('P'. $d .'DT'. $hr .'H'));
                                                                                        $sd = $ST;
                                                                                      } else {                     /**zonder een van voorgaande **/


                                                                                                    $hours = 5 * $h;

                                                                                                    $d = floor ($hours / 24);
                                                                                                    $hr = floor (($hours - $d * 24) / 60);

                                                                                                    $ST = new DateTime($sd);
                                                                                                    date_add($ST, new DateInterval('P'. $d .'DT'. $hr .'H'));
                                                                                                    $sd = $ST;
                                                                                      }


                                                                        }





                                             if ($today < $ST){           /**voorwaarde verschil tussen vandaag en  stopdatum **/


                                                    $bnfVal = $v;

                                                }else{

                                                   $bnfVal = 0;
                                                }

                                        }else{                                  /**indien geen stopdatum**/

                                                $ed = $prec->getEndDate();      /**einddatum opzoeken **/
                                                $today = date("Y-m-d H:i:s");

                                                $h = $f->getHlf();              /**hlf ophalen **/


                                                                           if (preg_match("/d/i", $h)) {   /** in de juiste vorm gieten van hlf om bij de einddatum te tellen**/


                                                                            $hlf = explode(" ", $h); /** indien met spatie **/
                                                                            $days = 5 * $hlf[0];

                                                                            $m = floor ($days / 30);
                                                                            $d = floor ($days - $m * 30);
                                                                                                              /** echo 'plus'. $m .'maanden en '. $d .'dagen is :';**/

                                                                            $ET = new DateTime($ed);

                                                                             date_add($ET, new DateInterval('P'. $m .'M'. $d .'D'));
                                                                             $ed = $ET;

                                                                            } else {

                                                                                    if (preg_match("/-/i", $h)) { /** indien met koppelteken **/

                                                                                        $hlf = explode("-", $h);
                                                                                        $hours = 5 * $hlf[1];

                                                                                        $d = floor ($hours / 24);
                                                                                        $hr = floor ($hours - $d * 24);
                                                                                                                    /**echo 'plus'. $d .'dagen en '. $hr .'uren is :';**/
                                                                                        $ET = new DateTime($ed);
                                                                                        date_add($ET, new DateInterval('P'. $d .'DT'. $hr .'H'));
                                                                                        $ed = $ET;
                                                                                      } else {                     /**zonder een van voorgaande **/


                                                                                                    $hours = 5 * $h;

                                                                                                    $d = floor ($hours / 24);
                                                                                                    $hr = floor (($hours - $d * 24) / 60);

                                                                                                    $ET = new DateTime($ed);
                                                                                                    date_add($ET, new DateInterval('P'. $d .'DT'. $hr .'H'));
                                                                                                    $ed = $ET;
                                                                                      }


                                                                        }



                                                    if($today < $ET){           /** als vandaag nog voor de einddatum is **/

                                                            $bnfVal = $v;       /** bnfwaarde meerekenen**/
                                                            /**echo $v.'+';**/
                                                         }else{

                                                            $bnfVal = 0;        /** anders niet meerekenen**/
                                                        }

                                                }
                                          $bnfWaarde += $bnfVal;                /** gevonden waarde bij bnfWaarde optellen **/
                                    }

                           endforeach;

                    endforeach;
        }
        return $bnfWaarde;

    }
  public function getPrescriptions($id)
  {
    $q = Doctrine_Query::create()
    ->from('AdPrescription p')
    ->where('p.user_patient_id = ?', $id);
return $q->execute();
  }
  public function getNonPsycho(){
      return Doctrine_Query::create()->from('AdNonPsychoPat npp')->where('npp.ad_patient_id = ?',$this->getPatientId())->execute();
  }
  public function getAduserpatients(){
    $adUserPatients = Doctrine_Query::create()->from('AdUserPatient aup')->where('aup.patient_id = ?',$this->getPatientId())->execute();
    return $adUserPatients;
  }
}