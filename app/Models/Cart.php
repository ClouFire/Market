<?php

namespace App\Models;

use PHPFramework\Model;
class Cart extends Model
{
    protected string $table = 'cart';
    protected array $loaded = ['product_id', 'product_amount', 'return_url', 'product_cart_amount', 'shop_sizes'];
    protected array $order_loaded = ['c_fname', 'c_lname', 'c_email_address', 'c_country', 'c_address', 'c_state_country', 'c_postal_zip', 'c_phone', 'c_companyname', 'c_order_notes', 'c_total',];


    protected array $fillable = ['image', 'title', 'price', 'quantity', 'good_id'];

    protected array $rules = [
        'required' => ['c_fname', 'c_lname', 'c_email_address', 'c_country', 'c_address', 'c_state_country', 'c_postal_zip', 'c_phone', ],
        'email' => ['c_email_address'],
        'lengthMin' => [['c_phone', 11], ['c_country', 2]],
    ];
    protected array $labels = [
        'c_fname' => 'First name',
        'c_lname' => 'Second name',
        'c_email_address' => 'Email',
        'c_state_country' => 'State / Country',
        'c_postal_zip' => 'Posta / Zip',
        'c_phone' => 'Phone',
        'c_address' => 'Address',
    ];


}