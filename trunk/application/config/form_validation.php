<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$CI =& get_instance();

$config = array(
    'auth/registrattion'                    => array(
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
            'field'     => 'place_of_birth_id',
            'label'     => 'lang:label_place_of_birth_id',
            'rules'     => 'trim|required|xss_clean|numeric'
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
            'rules'     => 'trim|required|xss_clean|decimal'
        ),
        array(
            'field'     => 'category_one',
            'label'     => 'lang:label_category_one',
            'rules'     => 'trim|required|integer'
        ),
        array(
            'field'     => 'category_two',
            'label'     => 'lang:label_category_two',
            'rules'     => 'trim|required|integer'
        ),
        array(
            'field'     => 'category_three',
            'label'     => 'lang:label_category_three',
            'rules'     => 'trim|required|integer'
        ),
        array(
            'field'     => 'category_four',
            'label'     => 'lang:label_category_four',
            'rules'     => 'trim|required|integer'
        ),
        array(
            'field'     => 'category_five',
            'label'     => 'lang:label_category_five',
            'rules'     => 'trim|required|integer'
        ),
        array(
            'field'     => 'vs',
            'label'     => 'lang:label_vs',
            'rules'     => 'trim|required|integer|min_length[4]|max_length[10]'
        )
    ),
    'auth/login'                 => array(
        array(
            'field'     => 'email',
            'label'     => 'lang:label_email',
            'rules'     => 'required|trim|xss_clean'
        ),
        array(
            'field'     => 'password',
            'label'     => 'lang:label_password',
            'rules'     => 'required|trim|xss_clean'
        )
    ),
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */