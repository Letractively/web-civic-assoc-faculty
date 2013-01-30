<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$CI =& get_instance();

$config = array(
    'auth/registration'                   => array(
        array(
            'field'     => 'name',
            'label'     => 'lang:label_name',
            'rules'     => 'trim|required|xss_clean'
        ),
        array(
            'field'     => 'surname',
            'label'     => 'lang:label_surname',
            'rules'     => 'trim|required|xss_clean'
        ),
        array(
            'field'     => 'username',
            'label'     => 'lang:label_username',
            'rules'     => 'trim|required|xss_clean|is_unique[users.user_username]'
        ),
        array(
            'field'     => 'password',
            'label'     => 'lang:label_password',
            'rules'     => 'trim|required|xss_clean|min_length[6]'
        ),
        array(
            'field'     => 'password_again',
            'label'     => 'lang:label_password_again',
            'rules'     => 'trim|required|xss_clean|min_length[6]|matches[password]'
        ),
        array(
            'field'     => 'email',
            'label'     => 'lang:label_email',
            'rules'     => 'trim|required|xss_clean|is_unique[users.user_email]|valid_email'
        ),
        array(
            'field'     => 'phone',
            'label'     => 'lang:label_phone',
            'rules'     => 'trim|xss_clean|numeric'
        ),
        array(
            'field'     => 'place_of_birth',
            'label'     => 'lang:label_place_of_birth',
            'rules'     => 'trim|xss_clean'
        ),
        array(
            'field'     => 'postcode',
            'label'     => 'lang:label_postcode',
            'rules'     => 'trim|xss_clean|numeric'
        ),
        array(
            'field'     => 'degree_year',
            'label'     => 'lang:label_degree',
            'rules'     => 'trim|required|xss_clean|numeric'
        ),
        array(
            'field'     => 'total_sum',
            'label'     => 'lang:label_total_sum',
            'rules'     => 'trim|required|xss_clean|greater_or_equal_than[5]'
        ),
        array(
            'field'     => 'vs',
            'label'     => 'lang:label_vs',
            'rules'     => 'trim|required|integer|min_length[4]|max_length[10]'
        )
    ),
    'auth/login'                    => array(
        array(
            'field'     => 'username',
            'label'     => 'lang:labelusername',
            'rules'     => 'required|trim|xss_clean'
        ),
        array(
            'field'     => 'password',
            'label'     => 'lang:label_password',
            'rules'     => 'required|trim|xss_clean'
        )
    ),
    'correspondence'          => array(
        array(
            'field'     => 'correspondence_sender',
            'label'     => 'lang:label_correspondence_sender',
            'rules'     => 'required|trim|xss_clean|valid_email'
        ),
        array(
            'field'     => 'correspondence_subject',
            'label'     => 'lang:label_correspondence_subject',
            'rules'     => 'required|trim|xss_clean'
        ),
        array(
            'field'     => 'correspondence_content',
            'label'     => 'lang:label_correspondence_content',
            'rules'     => 'trim|required|xss_clean'
        )
    ),
    'degrees/add'                   => array(
            array(
                'field'     => 'degree_name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'  
            ),
            array(
                 'field'     => 'degree_grade',
                'label'     => 'lang:label_grade',
                'rules'     => 'trim|required|xss_clean|numeric'
            )
    ),
    'degrees/edit'                  => array(
           array(
                'field'     => 'degree_name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'  
            ),
            array(
                'field'     => 'degree_grade',
                'label'     => 'lang:label_grade',
                'rules'     => 'trim|required|xss_clean|integer'
            )
    ),
    'email_types/add'               => array(
        array(
                'field'     => 'email_type_name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
        )
    ),
    'email_types/edit'               => array(
        array(
                'field'     => 'email_type_name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
        )
    ),
    'event_categories/add'          => array(
        array(
                'field'     => 'event_category_name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
        )
    ),
    'event_categories/edit'          => array(
        array(
                'field'     => 'event_category_name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
        )
    ),
    'events/add'                    => array(
            array(
                'field'     => 'event_category_id',
                'label'     => 'lang:label_event_category_id',
                'rules'     => 'trim|xss_clean'
            ),
            array(
                'field'     => 'priority',
                'label'     => 'lang:label_prioriy',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'from',
                'label'     => 'lang:label_from',
                'rules'     => 'trim|required|xss_clean|valid_datetime'
            ),
            array(
                'field'     => 'to',
                'label'     => 'lang:label_to',
                'rules'     => 'trim|required|xss_clean|valid_datetime'
            ),
            array(
                'field'     => 'about',
                'label'     => 'lang:label_about',
                'rules'     => 'trim|required|xss_clean'
            )
    ),
    'events/edit'                    => array(
            array(
                'field'     => 'event_category_id',
                'label'     => 'lang:label_event_category_id',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'priority',
                'label'     => 'lang:label_prioriy',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'from',
                'label'     => 'lang:label_from',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'to',
                'label'     => 'lang:label_to',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'about',
                'label'     => 'lang:label_about',
                'rules'     => 'trim|required|xss_clean'
            )
    ),
    'pages/edit'                            => array(
            array(
                'field'     => 'page_text',
                'label'     => 'lang:label_text',
                'rules'     => 'trim|required|xss_clean'
            )
    ),
    'posts/add'                             => array(
            array(
                'field'     => 'title',
                'label'     => 'lang:label_subject',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'priority',
                'label'     => 'lang:label_priority',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'content',
                'label'     => 'lang:label_content',
                'rules'     => 'trim|required|xss_clean'
            )
    ),
    'posts/edit'                             => array(
            array(
                'field'     => 'title',
                'label'     => 'lang:label_subject',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'priority',
                'label'     => 'lang:label_priority',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'content',
                'label'     => 'lang:label_content',
                'rules'     => 'trim|required|xss_clean'
            )
    ),    
    'project_categories/add'                => array(
            array(
                'field'     => 'project_category_name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'project_category_cash',
                'label'     => 'lang:label_capital',
                'rules'     => 'trim|xss_clean|numeric'
            )
    ),
    'project_categories/edit'                => array(
            array(
                'field'     => 'project_category_name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'project_category_cash',
                'label'     => 'lang:label_capital',
                'rules'     => 'trim|xss_clean|numeric'
            )
    ),
    'project_categories/add_transaction'                  => array(
            array(
                'field'     => 'to',
                'label'     => 'lang:label_to',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'cash',
                'label'     => 'lang:label_cash',
                'rules'     => 'trim|required|xss_clean|numeric'
            )
    ),
    'projects/add'                          => array(
            array(
                'field'     => 'name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'about',
                'label'     => 'lang:label_about',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'priority',
                'label'     => 'lang:label_priority',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'project_category_id',
                'label'     => 'lang:label_project_category_id',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'booked_cash',
                'label'     => 'lang:label_booked_cash',
                'rules'     => 'trim|required|xss_clean|numeric|is_natural'
            ),
            array(
                'field'     => 'from',
                'label'     => 'lang:label_from',
                'rules'     => 'trim|required|xss_clean|valid_date'
            ),
            array(
                'field'     => 'to',
                'label'     => 'lang:label_to',
                'rules'     => 'trim|required|xss_clean|valid_date'
            )
    ),
    'projects/edit'                          => array(
            array(
                'field'     => 'name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'about',
                'label'     => 'lang:label_about',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'priority',
                'label'     => 'lang:label_priority',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'project_category_id',
                'label'     => 'lang:label_project_category_id',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'booked_cash',
                'label'     => 'lang:label_booked_cash',
                'rules'     => 'trim|required|xss_clean|numeric|is_natural'
            ),
            array(
                'field'     => 'from',
                'label'     => 'lang:label_from',
                'rules'     => 'trim|required|xss_clean|valid_date'
            ),
            array(
                'field'     => 'to',
                'label'     => 'lang:label_to',
                'rules'     => 'trim|required|xss_clean|valid_date'
            )
    ),
    'projects/add_project_item'                 => array(
            array(
                'field'     => 'project_item_name',
                'label'     => 'lang:label_item',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'project_item_price',
                'label'     => 'lang:label_price',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'user_fullname',
                'label'     => 'lang:label_user',
                'rules'     => 'trim|required|xss_clean|numeric'
            )
    ),
    'projects/edit_project_item'                 => array(
            array(
                'field'     => 'project_item_name',
                'label'     => 'lang:label_item',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'project_item_price',
                'label'     => 'lang:label_price',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'user_fullname',
                'label'     => 'lang:label_user',
                'rules'     => 'trim|required|xss_clean|numeric'
            )
    ),
    'studies/add'                               => array(
            array(
                'field'     => 'study_program_name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
            )
    ),
    'studies/edit'                               => array(
            array(
                'field'     => 'study_program_name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
            )
    ),
    'users/add'                                  => array(
        array(
            'field'     => 'name',
            'label'     => 'lang:label_name',
            'rules'     => 'trim|required|xss_clean'
        ),
        array(
            'field'     => 'surname',
            'label'     => 'lang:label_surname',
            'rules'     => 'trim|required|xss_clean'
        ),
        array(
            'field'     => 'username',
            'label'     => 'lang:label_username',
            'rules'     => 'trim|required|xss_clean'
        ),
        array(
            'field'     => 'password',
            'label'     => 'lang:label_password',
            'rules'     => 'trim|required|xss_clean|min_length[6]'
        ),
        array(
            'field'     => 'password_again',
            'label'     => 'lang:label_password_again',
            'rules'     => 'trim|required|xss_clean|min_length[6]|matches[password]'
        ),
        array(
            'field'     => 'email',
            'label'     => 'lang:label_email',
            'rules'     => 'trim|required|xss_clean|is_unique[users.user_email]|valid_email'
        ),
        array(
            'field'     => 'phone',
            'label'     => 'lang:label_phone',
            'rules'     => 'trim|xss_clean|numeric'
        ),
        array(
            'field'     => 'place_of_birth',
            'label'     => 'lang:label_place_of_birth',
            'rules'     => 'trim|xss_clean'
        ),
        array(
            'field'     => 'postcode',
            'label'     => 'lang:label_postcode',
            'rules'     => 'trim|xss_clean|numeric'
        ),
        array(
            'field'     => 'degree_year',
            'label'     => 'lang:label_degree',
            'rules'     => 'trim|required|xss_clean|numeric'
        )
    ),
    'users/edit'                                => array(
        array(
            'field'         => 'username',
            'label'         => 'lang:label_username',
            'rules'         => 'trim|required|xss_clean'
        ),
        array(
            'field'         => 'name',
            'label'         => 'lang:label_name',
            'rules'         => 'trim|required|xss_clean'
        ),
        array(
            'field'         => 'surname',
            'label'         => 'lang:label_surname',
            'rules'         => 'trim|required|xss_clean'
        ),
        array(
            'field'         => 'password',
            'label'         => 'lang:label_password',
            'rules'         => 'trim|xss_clean|min_length[6]'
        ),
        array(
            'field'         => 'password_again',
            'label'         => 'lang:label_password_again',
            'rules'         => 'trim|xss_clean|matches[password]'
        ),
        array(
            'field'         => 'email',
            'label'         => 'lang:label_email',
            'rules'         => 'trim|required|xss_clean|valid_email'
        ),
        array(
            'field'         => 'phone',
            'label'         => 'lang:label_phone',
            'rules'         => 'trim|xss_clean|numeric'
        ),
        array(
            'field'         => 'place_of_birth',
            'label'         => 'lang:label_place_of_birth',
            'rules'         => 'trim|xss_clean'
        ),
        array(
            'field'         => 'postcode',
            'label'         => 'lang:label_postcode',
            'rules'         => 'trim|xss_clean|numeric'
        ),
        array(
            'field'         => 'degree_year',
            'label'         => 'lang:label_degree',
            'rules'         => 'trim|required|xss_clean|numeric'
        )
    )
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */