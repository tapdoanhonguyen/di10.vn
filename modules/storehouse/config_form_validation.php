<?php 

$config = array(
    'auth/login' => array(
        array(
            'field' => 'identity',
            'label' => 'username',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'label' => 'password',
            'rules' => 'required'
        )
    ),
    'auth/create_user' => array(
        array(
            'field' => 'first_name',
            'label' => 'first_name',
            'rules' => 'required'
        ),
        array(
            'field' => 'last_name',
            'label' => 'last_name',
            'rules' => 'required'
        ),
        array(
            'field' => 'username',
            'label' => 'username',
            'rules' => 'required|alpha_dash'
        ),
        array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'phone',
            'label' => 'phone',
            'rules' => 'required'
        ),
        array(
            'field' => 'company',
            'label' => 'company',
            'rules' => 'required'
        ),
        array(
            'field' => 'gender',
            'label' => 'gender',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'label' => 'password',
            'rules' => 'required|min_length[7]|max_length[20]'
        ),
        array(
            'field' => 'confirm_password',
            'label' => 'confirm_password',
            'rules' => 'required|min_length[7]|max_length[20]|matches[password]'
        ),
    ),
    'auth/edit_user' => array(
        array(
            'field' => 'first_name',
            'label' => 'first_name',
            'rules' => 'required'
        ),
        array(
            'field' => 'last_name',
            'label' => 'last_name',
            'rules' => 'required'
        ),
        array(
            'field' => 'username',
            'label' => 'username',
            'rules' => 'required|alpha_dash'
        ),
        array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'phone',
            'label' => 'phone',
            'rules' => 'required'
        ),
        array(
            'field' => 'company',
            'label' => 'company',
            'rules' => 'required'
        ),
        array(
            'field' => 'gender',
            'label' => 'gender',
            'rules' => 'required'
        ),
    ),
    'products/add' => array(
        array(
            'field' => 'code',
            'label' => 'product_code',
            'rules' => 'trim|min_length[2]|max_length[20]|required|alpha_dash'
        ),
        array(
            'field' => 'name',
            'label' => 'product_name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'category',
            'label' => 'cname',
            'rules' => 'required'
        ),
        array(
            'field' => 'barcode_symbology',
            'label' => 'barcode_symbology',
            'rules' => 'required'
        ),
        array(
            'field' => 'unit',
            'label' => 'product_unit',
            'rules' => 'required'
        ),
        array(
            'field' => 'price',
            'label' => 'product_price',
            'rules' => 'required|numeric'
        )
    ),
    'companies/add' => array(
        array(
            'field' => 'name',
            'label' => 'contact_person',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'company',
            'label' => 'company',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'email',
            'label' => 'email_address',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'address',
            'label' => 'address',
            'rules' => 'required'
        ),
        array(
            'field' => 'city',
            'label' => 'city',
            'rules' => 'required'
        ),
        array(
            'field' => 'phone',
            'label' => 'phone',
            'rules' => 'required'
        )
    ),
    'companies/add_user' => array(
        array(
            'field' => 'first_name',
            'label' => 'first_name',
            'rules' => 'required'
        ),
        array(
            'field' => 'last_name',
            'label' => 'last_name',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'required|valid_email'
        )
    ),
);

