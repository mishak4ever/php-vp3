<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'category' => [
        'title' => 'Categories',

        'actions' => [
            'index' => 'Categories',
            'create' => 'New Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            
        ],
    ],

    'productum' => [
        'title' => 'Producta',

        'actions' => [
            'index' => 'Producta',
            'create' => 'New Productum',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'product' => [
        'title' => 'Products',

        'actions' => [
            'index' => 'Products',
            'create' => 'New Product',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'title' => 'Title',
            'category_id' => 'Category',
            'price' => 'Price',
            'image_id' => 'Image',
            'description' => 'Description',
            
        ],
    ],

    'order' => [
        'title' => 'Orders',

        'actions' => [
            'index' => 'Orders',
            'create' => 'New Order',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'title' => 'Title',
            'categories' => 'Categories',
            'products' => 'Products',
            'cost' => 'Cost',
            'user_id' => 'User',
            'active' => 'Active',
            'complete' => 'Complete',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];