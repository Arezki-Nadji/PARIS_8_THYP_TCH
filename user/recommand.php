<?php

function similarity_distance($matrix,$person1,$person2)
{
    $similaire=array();
    $sum = 0;
    foreach($matrix[$person1] as $key => $value)
    {
        //on vérifie que la personne a bien rate le film i
        if(array_key_exists($key,$matrix[$person2]))
        {
            $similaire[$key]=1;
        }
    }
        //si la personne n'é évaluer aucun film on return 0
        if($similaire==0)
        {
            return 0;
        }
        //on calcule la distance euclidienne pour chaque personne 
        foreach($matrix[$person1] as $key => $value)
        {
            if(array_key_exists($key,$matrix[$person2]))
                {
                $sum= $sum + pow(floatval($value)-floatval($matrix[$person2][$key]),2);
                }
       
        }
    return 1/(1+sqrt($sum));
}

function getRecommendation($matrix,$person)
{
    $total = array();
    $simSums = array();
    $ranks = array();
    foreach($matrix as $otherPerson => $value)
    {
        if($otherPerson!=$person)
        {
            //calculer le score de similarité avec chaque utilisateur
            $sim = similarity_distance($matrix,$person,$otherPerson);
            foreach($matrix[$otherPerson] as $key=>$value)
            {
                //on s'ssure de ne pas prendre la personne en question 
                if(!array_key_exists($key,$matrix[$person]))
                {
                    if(!array_key_exists($key,$total))
                    {
                        $total[$key]=0;
                    }
                    $total[$key]+=floatval($matrix[$otherPerson][$key])*$sim;
                    if(!array_key_exists($key,$simSums))
                    {
                        $simSums[$key]=0;
                    }
                    $simSums[$key]+=$sim;
                }
            }
           
        }
    }
    foreach($total as $key => $value)
    {
        $ranks[$key]=$value/$simSums[$key];
       
        
    }
    array_multisort($ranks,SORT_DESC);
    return $ranks;
}
?>