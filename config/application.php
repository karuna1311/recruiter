<?php

return [
    'application_status'=>
        [
           '1'=>[
           	'name'=>'Personal Information',
           	'gate_name'=>'personal_info',
           	'route'=>'personalInfo.index',
           ],
           '2'=>[
           	'name'=>'Reservation',
           	'gate_name'=>'reservation',
           	'route'=>'reservation.index',
           ],
        //    '3'=>[
        //    	'name'=>'Details Of Inservice Quota',
        //    	'gate_name'=>'inservice_quota',
        //    	'route'=>'inserviceQuota.index',
        //    ],
           '4'=>[
           	'name'=>'Previous College Information',
           	'gate_name'=>'pre_college_info',
           	'route'=>'collegeInfo.index',
           ],
           '5'=>[
           	'name'=>'Medical Council Registration',
           	'gate_name'=>'medical_council',
           	'route'=>'medicalCouncil.index',
           ],
           '6'=>[
            'name'=>'Security Deposite',
            'gate_name'=>'security_deposite',
            'route'=>'securityDeposite.index',
           ],
           '7'=>[
            'name'=>'Preview',
            'gate_name'=>'preview',
            'route'=>'preview.index',
           ],
           '8'=>[
           	'name'=>'Declaration Of Candidates',
           	'gate_name'=>'declaration',
           	'route'=>'declaration.index',
           ],
           '9'=>[
            'name'=>'Session Application',
            'gate_name'=>'session_application',
            'route'=>'session.index',
           ],
           '10'=>[
            'name'=>'Payment',
            'gate_name'=>'payment',
            'route'=>'payment.index',
           ],
           '11'=>[
            'name'=>'Document Upload',
            'gate_name'=>'document_upload',
            'route'=>'document.index',
           ]
        ],
];
