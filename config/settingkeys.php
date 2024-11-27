<?php
  return[
    // payment information key
    "bitcoin_address_key" => "ki_bitcoin_address",
    "bitcoin_address_tag_key" => "ki_bitcoin_address_tag",
    "usdt_address_key" => "ki_usdt_address",
    "usdt_address_tag_key" => "ki_usdt_address_tag",
    "xmr_address_key" => "ki_xmr_address",
    "xmr_address_tag_key" => "ki_xmr_address_tag",

    "paypal_key" => "ki_paypal",
    "bank_key" => "ki_bank",
    "account_type_key" => "ki_account_type",
    "account_number_key" => "ki_account_number",
    "sort_code_key" => "ki_sort_code",
    "bitcoin_qr_code_key"=>"key_bitcoin_qr_code",
    "xmr_qr_code_key"=>"key_xmr_qr_code",
    "usdt_qr_code_key"=>"key_usdt_qr_code",

    // default payment addresses
    "ki_bitcoin_address" => 'default_ki_bitcoin_address',
    "ki_bitcoin_address_tag" => 'default_ki_bitcoin_address_tag',
    "ki_usdt_address" => 'default_ki_usdt_address',
    "ki_usdt_address_tag" => 'default_ki_usdt_address_tag',
    "ki_xmr_address" => 'default_ki_xmr_address',
    "ki_xmr_address_tag" => 'default_ki_xmr_address_tag',
    "ki_paypal" => "default_ki_paypal",
    "ki_bank" => "default_ki_bank",
    "ki_account_type" => "default_ki_account_type",
    "ki_account_number" => "default_ki_account_number",
    "ki_sort_code" => "default_ki_sort_code",
    "key_bitcoin_qr_code"=>"deafult_key_bitcoin_qr_code",
    "key_xmr_qr_code"=>"deafult_key_xmr_qr_code",
    "key_usdt_qr_code"=>"deafult_key_usdt_qr_code",



    // kyc verification keys
    "kyc_id_front" => "kyc_id_front",
    "kyc_id_back" => "kyc_id_back",
    "kyc_address_proof" => "kyc_address_proof",
    "kyc_selfie_proof" => "kyc_selfie_proof",

    "kyc_type" => [
          'birth_certificate' => 'Birth Certificate',
          'id_card'=>'ID Card',
          'passport'=>'Passport',
      ],


    //  user trade settings
    "trade_result" => "random",
    "trade_percentage" => "10",

    // PROMPS AND PERMISSIONS
      "prompts_permissions" => [
            "upgrade_prompt",
            "identity_prompt",
            "account_on_hold_prompt" ,
            "kyc_verification_prompt" ,
            "account_certificate_prompt",
            "tax_reference_prompt",
            "axillary_system_prompt",
            "trade_limit_prompt",
            "credit_facility_approval",
            "loan_facility_approval"
      ],



    "axillary_system_status" => "axillary_system_status",
    "trading_bot_status" => "trading_bot_status",


    // admin email
    'admin_email' => (env('APP_MODE') == 'production') ? 'admin@100xbrokerage.com' : 'demo@demo.com',
    'support_email' =>  (env('APP_MODE') == 'production') ? 'support@100xbrokerage.com' : 'demo@demo.com',
    'phone_number' => (env('APP_MODE') == 'production') ? '+1646 499 2365' : "+1(111)111-1111",

];
