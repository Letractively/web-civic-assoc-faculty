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
            'rules'     => 'trim|required|xss_clean|numeric'
        ),
        array(
            'field'     => 'study_program_id',
            'label'     => 'lang:label_study_program_id',
            'rules'     => 'trim|required|xss_clean|numeric'
        ),
        array(
            'field'     => 'degree_id',
            'label'     => 'lang:label_degree_id',
            'rules'     => 'trim|required|xss_clean|numeric'
        ),
        array(
            'field'     => 'place_of_birth',
            'label'     => 'lang:label_place_of_birth',
            'rules'     => 'trim|required|xss_clean'
        ),
        array(
            'field'     => 'postcode',
            'label'     => 'lang:label_postcode',
            'rules'     => 'trim|required|xss_clean|numeric'
        ),
        array(
            'field'     => 'degree_year',
            'label'     => 'lang:label_degree',
            'rules'     => 'trim|required|xss_clean|numeric'
        ),
        array(
            'field'     => 'total_sum',
            'label'     => 'lang:label_total_tum',
            'rules'     => 'trim|required|xss_clean|numeric'
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
                'field'     => 'name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'  
            ),
            array(
                 'field'     => 'grade',
                'label'     => 'lang:label_grade',
                'rules'     => 'trim|required|xss_clean|numeric'
            )
    ),
    'degrees/edit'                  => array(
           array(
                'field'     => 'name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'  
            ),
            array(
                'field'     => 'grade',
                'label'     => 'lang:label_grade',
                'rules'     => 'trim|required|xss_clean|integer'
            )
    ),
    'email_types/add'               => array(
        array(
                'field'     => 'name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
        )
    ),
    'email_types/edit'               => array(
        array(
                'field'     => 'name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
        )
    ),
    'event_categories/add'          => array(
        array(
                'field'     => 'name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
        )
    ),
    'event_categories/edit'          => array(
        array(
                'field'     => 'name',
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
    'payments/add'                      => array(
            array(
                'field'     => 'vs',
                'label'     => 'lang:label_vs',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'user_id',
                'label'     => 'lang:label_user_id',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'total_sum',
                'label'     => 'lang:label_total_sum',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'paid_sum',
                'label'     => 'lang:label_paid_sum',
                'rules'     => 'trim|required|xss_clean|numeric'
            )
    ),
    'payments/edit'                      => array(
            array(
                'field'     => 'vs',
                'label'     => 'lang:label_vs',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'user_id',
                'label'     => 'lang:label_user_id',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'total_sum',
                'label'     => 'lang:label_total_sum',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'paid_sum',
                'label'     => 'lang:label_paid_sum',
                'rules'     => 'trim|required|xss_clean|numeric'
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
    'project_categories/detail'              => array(
            array(
                'field'     => 'from',
                'label'     => 'lang:label_from',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
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
    'project_categories/add'                => array(
            array(
                'field'     => 'name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'cash',
                'label'     => 'lang:label_capital',
                'rules'     => 'trim|required|xss_clean|numeric'
            )
    ),
    'project_categories/edit'                => array(
            array(
                'field'     => 'name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'cash',
                'label'     => 'lang:label_capital',
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
                'rules'     => 'trim|required|xss_clean|numeric'
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
                'rules'     => 'trim|required|xss_clean|numeric'
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
            )
    ),
    'projects/add_project_item'                 => array(
            array(
                'field'     => 'name',
                'label'     => 'lang:label_item',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'price',
                'label'     => 'lang:label_price',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'user',
                'label'     => 'lang:label_user',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'date',
                'label'     => 'lang:label_date',
                'rules'     => 'trim|required|xss_clean'
            )
    ),
    'projects/edit_project_item'                 => array(
            array(
                'field'     => 'name',
                'label'     => 'lang:label_item',
                'rules'     => 'trim|required|xss_clean'
            ),
            array(
                'field'     => 'price',
                'label'     => 'lang:label_price',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'user',
                'label'     => 'lang:label_user',
                'rules'     => 'trim|required|xss_clean|numeric'
            ),
            array(
                'field'     => 'date',
                'label'     => 'lang:label_date',
                'rules'     => 'trim|required|xss_clean'
            )
    ),
    'studies/add'                               => array(
            array(
                'field'     => 'name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
            )
    ),
    'studies/edit'                               => array(
            array(
                'field'     => 'name',
                'label'     => 'lang:label_name',
                'rules'     => 'trim|required|xss_clean'
            )
    )
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */