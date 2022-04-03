<?php

return [
    /*
     |-------------------------------------------------
     | Define constant for Decentralization
     |-------------------------------------------------
     */
    'module_access' => [
        1 => 'Super Admin',
        2 => 'Platform',
        3 => 'Merchant',
        4 => 'Common'
    ],

    /*
     |-------------------------------------------------
     | Define constant for Pagination
     |-------------------------------------------------
     */
    'pagination' => [
        'limit' => 20
    ],

    /*
     |-------------------------------------------------
     | Define constant for Univerity
     |-------------------------------------------------
     */
    'university_type' => [
        'label' => [
            1 => 'CD',
            2 => 'DH',
        ],
        'key' => [
            'CD' => 1,
            'DH' => 2,
        ]
    ],

    /*
     |-------------------------------------------------
     | Define constant for score
     |-------------------------------------------------
     */
    'score_type' => [
        'label' => [
            1 => 'Xét điểm thi THPT',
            2 => 'Xét điểm học bạ',
            3 => 'Xét điểm thi ĐGNL'
        ],
        'key_int' => [
            'thpt_score'  => 1,
            'hocba_score' => 2,
            'dgnl_score'  => 3
        ],
        'key_text' => [
            1 => 'thpt_score',
            2 => 'hocba_score',
            3 => 'dgnl_score'
        ]
    ]
];
