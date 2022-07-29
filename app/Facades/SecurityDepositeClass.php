<?php

namespace App\Facades;

class SecurityDepositeClass 
{
    public function getAmount($nri,$seatType,$category)
    {
    	$amount='500000';
    	
    	if($nri==='YES') return '100000';

    	switch ($seatType) {
    		case 'GOVERNMENT SEATS ONLY':
    			(in_array($category, ['OPEN','EWS'])) ? $amount='25000': $amount= '12500';
    			break;
    		case 'BOTH GOVERNMENT AND PRIVATE SEATS':
    			$amount='100000';
    			break;
    		default:
    			$amount='500000';
    	}
    	return $amount;
    }
}
