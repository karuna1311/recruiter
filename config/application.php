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
           '3'=>[
           	'name'=>'Qualification',
           	'gate_name'=>'',
           	'route'=>'qualification.index',
           ],
           '4'=>[
           	'name'=>'Experience',
           	'gate_name'=>'',
           	'route'=>'experience.index',
           ],
           '5'=>[
            'name'=>'Preview',
            'gate_name'=>'preview',
            'route'=>'preview.index',
           ],
           '6'=>[
           	'name'=>'Declaration Of Candidates',
           	'gate_name'=>'declaration',
           	'route'=>'declaration.index',
           ],
           '7'=>[
            'name'=>'Document Upload',
            'gate_name'=>'document_upload',
            'route'=>'document.index',
           ]
        ],
];
