<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Call Methods and URL Definition
    |--------------------------------------------------------------------------
    |
    | Template:
    |
    | 'configName' => [
    |   'method' => 'METHOD (GET | POST | etc.)',
    |   'url' => 'relative url',
    |   'role' => (OPTIONAL) 'role authorized to use api',
    |  ]
    |
    */

    /*
    |--------------------------------------------------------------------------
    | IPC-BE API
    |--------------------------------------------------------------------------
    */
        /*
        |--------------
        | GENERAL API
        |--------------
        */

        'fetchForwardingOrderByUuid' => [
            'method' => 'POST',
            'url' => 'forwarding/order',
            'role' => 'general',
        ],

        'fetchYardOrderByUuid' => [
            'method' => 'POST',
            'url' => 'yard/order',
            'role' => 'general',
        ],

        'login' => [
            'method' => 'POST',
            'url' => '/auth/login',
            'role' => 'general',
        ],

        'logout' => [
            'method' => 'POST',
            'url' => '/auth/logout',
            'role' => 'general',
        ],

        'register' => [
            'method' => 'POST',
            'url' => '/auth/register',
            'role' => 'general',
        ],

        'changePassword' => [
            'method' => 'POST',
            'url' => '/auth/password/change',
            'role' => 'general',
        ],

        'refreshToken' => [
            'method' => 'POST',
            'url' => '/oauth/token',
            'role' => 'general',
        ],

        'getBanks' => [
            'method' => 'GET',
            'url' => '/payment/banks',
            'role' => 'general',
        ],

        'getBankDetail' => [
            'method' => 'GET',
            'url' => '/payment/bank',
            'role' => 'general',
        ],

        'getPaymentByInvoiceKey' => [
            'method' => 'GET',
            'url' => '/payment/invoice',
            'role' => 'general',
        ],

        'createPayment' => [
            'method' => 'POST',
            'url' => '/payment/create',
            'role' => 'general',
        ],

        // Customer - Admin (checked in BE)
        'requestGatePass' => [
            'method' => 'POST',
            'url' => '/yard/service/gatepass/request',
            'role' => 'general',
        ],

            /*
            |--------------
            | GENERAL API: APPLETS
            |--------------
            */
            'verifyForwardingKey' => [
                'method' => 'POST',
                'url' => '/verify/key',
            ],

            "approveQuotationKey" => [
                'method' => 'POST',
                'url' => '/verify/approve-quotation',
            ],

            "acceptProformaKey" => [
                'method' => 'POST',
                'url' => '/verify/accept-proforma',
            ],

            'verifyAccount' => [
                'method' => 'POST',
                'url' => '/auth/verify-account',
            ],


        /*
        |--------------
        | CUSTOMER API
        |--------------
        */
        'createForwarding' => [
            'method' => 'POST',
            'url' => 'forwarding/order/create',
            'role' => 'customer',
        ],

        'fetchForwardingOrdersUser' => [
            'method' => 'POST',
            'url' => 'forwarding/order/user',
            'role' => 'customer'
        ],

        'fetchOutstandingForwardingOrdersUser' => [
            'method' => 'POST',
            'url' => 'forwarding/orders/user/outstanding',
            'role' => 'customer',
        ],

        'fetchActiveForwardingOrdersUser' => [
            'method' => 'POST',
            'url' => 'forwarding/orders/user/active',
            'role' => 'customer',
        ],

        'fetchCompletedForwardingOrdersUser' => [
            'method' => 'POST',
            'url' => 'forwarding/orders/user/completed',
            'role' => 'customer',
        ],

        'fetchCancelledForwardingOrdersUser' => [
            'method' => 'POST',
            'url' => 'forwarding/orders/user/cancelled',
            'role' => 'customer',
        ],

        'updateStatusOrderApproved' => [
            'method' => 'POST',
            'url' => '/forwarding/status/approved',
            'role' => 'customer',
        ],

        'fetchCountries' => [
            'method' => 'POST',
            'url' => '/data/country',
        ],

        'fetchAirports' => [
            'method' => 'POST',
            'url' => '/data/airport',
        ],

        'fetchPorts' => [
            'method' => 'POST',
            'url' => '/data/port',
        ],

        "acceptProforma" => [
            'method' => 'POST',
            'url' => '/billing/proforma/accept',
            'role' => 'customer',
        ],

        "rejectProforma" => [
            'method' => 'POST',
            'url' => '/billing/proforma/reject',
            'role' => 'customer',
        ],

        "fetchInvoicesByUser" => [
            'method' => 'POST',
            'url' => '/billing/invoice/get/user',
            'role' => 'customer',
        ],

        'fetchBLYardService' => [
            'method' => 'GET',
            'url' => '/yard/service/bl',
            'role' => 'customer',
        ],

        'fetchYardBLPaidthru' => [
            'method' => 'GET',
            'url' => '/yard/service/bl/paidthru',
            'role' => 'customer',
        ],

        'fetchYardContainerService' => [
            'method' => 'GET',
            'url' => '/yard/service/container',
            'role' => 'customer',
        ],

        'fetchYardContainerPaidthru' => [
            'method' => 'GET',
            'url' => '/yard/service/container/paidthru',
            'role' => 'customer',
        ],

        'fetchYardBLSPPB' => [
            'method' => 'GET',
            'url' => '/yard/service/sppb/bl',
            'role' => 'customer',
        ],

        'storeYardOrder' => [
            'method' => 'POST',
            'url' => '/yard/order/create',
            'role' => 'customer',
        ],

        'fetchOutstandingYardOrderUsers' => [
            'method' => 'POST',
            'url' => '/yard/orders/user/outstanding',
            'role' => 'customer',
        ],

        'fetchActiveYardOrderUsers' => [
            'method' => 'POST',
            'url' => '/yard/orders/user/active',
            'role' => 'customer',
        ],

        'fetchCompletedYardOrderUsers' => [
            'method' => 'POST',
            'url' => '/yard/orders/user/completed',
            'role' => 'customer',
        ],

        'fetchCancelledYardOrderUsers' => [
            'method' => 'POST',
            'url' => '/yard/orders/user/cancelled',
            'role' => 'customer',
        ],

        'fetchOutstandingOrdersUser' => [
            'method' => 'POST',
            'url' => '/orders/user/outstanding',
            'role' => 'customer',
        ],

        'fetchActiveOrdersUser' => [
            'method' => 'POST',
            'url' => '/orders/user/active',
            'role' => 'customer',
        ],

        'fetchCompletedOrdersUser' => [
            'method' => 'POST',
            'url' => '/orders/user/completed',
            'role' => 'customer',
        ],

        'fetchCancelledOrdersUser' => [
            'method' => 'POST',
            'url' => '/orders/user/cancelled',
            'role' => 'customer',
        ],

        'fetchHomeData' => [
            'method' => 'POST',
            'url' => '/dashboard/customer',
            'role' => 'customer',
        ],

        /*
        |--------------
        | ADMIN API
        |--------------
        */
        'fetchForwardingOrders' => [
            'method' => 'POST',
            'url' => 'forwarding/orders',
            'role' => 'admin',
        ],

        'fetchOpenForwardingOrders' => [
            'method' => 'POST',
            'url' => 'forwarding/orders/open',
            'role' => 'admin',
        ],

        'fetchOutstandingForwardingOrders' => [
            'method' => 'POST',
            'url' => 'forwarding/orders/outstanding',
            'role' => 'admin',
        ],

        'fetchActiveForwardingOrders' => [
            'method' => 'POST',
            'url' => 'forwarding/orders/active',
            'role' => 'admin',
        ],

        'fetchCompletedForwardingOrders' => [
            'method' => 'POST',
            'url' => 'forwarding/orders/completed',
            'role' => 'admin',
        ],

        'fetchCancelledForwardingOrders' => [
            'method' => 'POST',
            'url' => 'forwarding/orders/cancelled',
            'role' => 'admin',
        ],

        'fetchServicesSelect2' => [
            'method' => 'POST',
            'url' => 'forwarding/service/select2',
            'role' => 'admin',
        ],

        'fetchBasedonSelect2' => [
            'method' => 'POST',
            'url' => 'forwarding/service/basedon',
            'role' => 'admin',
        ],

        'acceptOrder' => [
            'method' => 'POST',
            'url' => '/forwarding/status/processing',
            'role' => 'admin',
        ],

        'updateStatusWaitingManagerApproval' => [
            'method' => 'POST',
            'url' => '/forwarding/status/waiting-manager-approval',
            'role' => 'admin',
        ],

        'createQuotationHeader' => [
            'method' => 'POST',
            'url' => 'forwarding/quotation/header',
            'role' => 'admin',
        ],

        'manipulateOrderQuotation' => [
            'method' => 'POST',
            'url' => 'forwarding/quotation',
            'role' => 'admin',
        ],

        "fetchTasksByOrder" => [
            'method' => 'POST',
            'url' => '/tasks',
            'role' => 'admin',
        ],

        "executeTask" => [
            'method' => 'POST',
            'url' => '/task/execute',
            'role' => 'admin',
        ],

        "triggerInvoicePaid" => [
            'method' => 'POST',
            'url' => '/billing/invoice/paid',
            'role' => 'admin',
        ],

        'fetchOutstandingYardOrders' => [
            'method' => 'POST',
            'url' => '/yard/orders/outstanding',
            'role' => 'admin',
        ],

        'fetchActiveYardOrders' => [
            'method' => 'POST',
            'url' => '/yard/orders/active',
            'role' => 'admin',
        ],

        'fetchCompletedYardOrders' => [
            'method' => 'POST',
            'url' => '/yard/orders/completed',
            'role' => 'admin',
        ],

        'fetchCancelledYardOrders' => [
            'method' => 'POST',
            'url' => '/yard/orders/cancelled',
            'role' => 'admin',
        ],

        'approveYardOrder' => [
            'method' => 'POST',
            'url' => '/yard/order/accept',
            'role' => 'admin',
        ],

        'fetchOpenOrders' => [
            'method' => 'POST',
            'url' => 'orders/open',
            'role' => 'admin',
        ],

        'fetchOutstandingOrders' => [
            'method' => 'POST',
            'url' => 'orders/outstanding',
            'role' => 'admin',
        ],

        'fetchActiveOrders' => [
            'method' => 'POST',
            'url' => 'orders/active',
            'role' => 'admin',
        ],

        'fetchCompletedOrders' => [
            'method' => 'POST',
            'url' => 'orders/completed',
            'role' => 'admin',
        ],

        'fetchCancelledOrders' => [
            'method' => 'POST',
            'url' => 'orders/cancelled',
            'role' => 'admin',
        ],

        'fetchDashboardAdminData' => [
            'method' => 'POST',
            'url' => '/dashboard/admin',
            'role' => 'admin',
        ],

        "fetchContractServices" => [
            'method' => 'GET',
            'url' => 'forwarding/service/contract',
            'role' => 'admin',
        ],


        /*
        |--------------
        | MANAGER API
        |--------------
        */
        'fetchOrdersMgmtApproval' => [
            'method' => 'POST',
            'url' => 'orders/mgmt',
            'role' => 'manager',
        ],

        'fetchAllOrdersMgmt' => [
            'method' => 'POST',
            'url' => 'orders/mgmt/all',
            'role' => 'manager',
        ],

        'fetchForwardingOrdersMgmtApproval' => [
            'method' => 'POST',
            'url' => 'forwarding/orders/request-manager-approval',
            'role' => 'manager',
        ],

        'updateStatusTicketSubmitted' => [
            'method' => 'POST',
            'url' => '/forwarding/status/ticket-submitted',
            'role' => 'manager',
        ],

        'updateStatusOrderCancelled' => [
            'method' => 'POST',
            'url' => '/forwarding/status/cancel',
            'role' => 'manager',
        ],


        /*
        |--------------
        | SA API
        |--------------
        */
        'fetchStaff' => [
            'method' => 'POST',
            'url' => '/user/staff',
            'role' => 'sa',
        ],

        'fetchInactiveStaff' => [
            'method' => 'POST',
            'url' => '/user/staff/inactive',
            'role' => 'sa',
        ],

        'fetchActiveUsers' => [
            'method' => 'GET',
            'url' => 'api/users/active',
            'role' => 'admin',
        ],

        'fetchInactiveUsers' => [
            'method' => 'GET',
            'url' => 'api/users/inactive',
            'role' => 'admin',
        ],

        'activateAccount' => [
            'method' => 'POST',
            'url' => 'api/users/activate',
            'role' => 'admin',
        ],

        'fetchUserByUuid' => [
            'method' => 'GET',
            'url' => 'api/users/uuid',
            'role' => 'general',
        ],

        'disableAccount' => [
            'method' => 'POST',
            'url' => 'api/users/disable',
            'role' => 'admin',
        ],

        'fetchAllPermissions' => [
            'method' => 'GET',
            'url' => '/user/permissions',
            'role' => 'sa',
        ],

        'registerStaff' => [
            'method' => 'POST',
            'url' => '/user/staff/register',
            'role' => 'sa',
        ],

        'resendVerification' => [
            'method' => 'POST',
            'url' => '/user/resend-verification',
            'role' => 'sa',
        ],

        'fetchDashboardSAData' => [
            'method' => 'POST',
            'url' => '/dashboard/sa',
            'role' => 'sa',
        ],

    /*
    |--------------------------------------------------------------------------
    | CLICKARGO API
    |--------------------------------------------------------------------------
    */
    'checkSchedule' => [
        'method' => 'POST',
        'url' => 'api/v1/check-schedule',
    ],

    'findUnloc' => [
        'method' => 'POST',
        'url' => 'api/v1/unlocs/find',
    ],
];
