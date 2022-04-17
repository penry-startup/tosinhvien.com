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
    ],
    /*
     |-------------------------------------------------
     | Define constant for sex
     |-------------------------------------------------
     */
    'sex' => [
        'label' => [
            1 => 'Nam',
            2 => 'Nữ',
            3 => 'LGBT',
        ],
        'key' => [
            'male'   => 1,
            'female' => 2,
            'lgbt'   => 3,
        ],
    ],

    /*
     |-------------------------------------------------
     | Define constant for active
     |-------------------------------------------------
     */
    'is_active' => [
        'label' => [
            0 => 'Inactive',
            1 => 'Active',
        ],
        'key' => [
            'inactive' => 0,
            'active'   => 1,
        ],
    ],

    /*
     |-------------------------------------------------
     | Define constant for draft
     |-------------------------------------------------
     */
    'is_draft' => [
        'label' => [
            0 => 'Is Real',
            1 => 'Is Draft',
        ],
        'key' => [
            'is_real'  => 0,
            'is_draft' => 1,
        ],
    ],
    /*
     |-------------------------------------------------
     | Define constant for Session keys
     |-------------------------------------------------
     */
    'session_keys' => [
        'prev_route_authenticate' => 'prev-route-authenticate'
    ]
];
