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
            'field'     => 'postcode_id',
            'label'     => 'lang:label_postcode_id',
            'rules'     => 'trim|required|xss_clean|numeric'
        ),
        array(
            'field'     => 'degree_year_id',
            'label'     => 'lang:label_degree_id',
            'rules'     => 'trim|required|xss_clean|numeric'
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