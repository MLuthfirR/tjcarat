<?php

namespace App\Http\Controllers\Helpers;

class InputFieldItems
{
    /**
     * FF Container Info Fields
     */
    public static $container_info_fields = [
        [
            "name" => "container_type",
            "label" => "Container type",
            "placeholder" => "Choose container type",
            "type" => "select",
            "options" => [
                [
                    "label" => 'FCL',
                    "value" => 'FCL'
                ],
                [
                    "label" => 'LCL',
                    "value" => 'LCL'
                ],
                [
                    "label" => 'GENERAL CARGO',
                    "value" => 'GENERAL_CARGO'
                ],
            ],
            "class" => "",
            "is_required" => True,
            "parsley_class" => "main",
        ],
    ];

    /**
     * FF Commodity Fields
     */
    public static $commodity_fields = [
        [
            "name" => "temp_commodity",
            "label" => "Commodity",
            "placeholder" => "Example: Electronics",
            "type" => "input",
            "class" => "t-input-commodity",
            "is_required" => True,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_qty",
            "label" => "Qty",
            "placeholder" => "Example: 23",
            "type" => "number",
            "class" => "t-input-commodity",
            "is_required" => True,
            "col" => 6,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_unit",
            "label" => "Unit",
            "placeholder" => "Example: pcs",
            "type" => "input",
            "class" => "t-input-commodity",
            "is_required" => True,
            "col" => 6,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_volume",
            "label" => "Volume",
            "placeholder" => "Example: 23",
            "type" => "number",
            "class" => "t-input-commodity",
            "is_required" => False,
            "col" => 6,
            "parsley_class" => "t-input-commodity",
            "helper_text" => "Empty volume unit will default to 'm3'",
        ],
        [
            "name" => "temp_volume_unit",
            "label" => "Volume Unit",
            "placeholder" => "Example: m3",
            "type" => "input",
            "class" => "t-input-commodity",
            "is_required" => False,
            "col" => 6,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_weight",
            "label" => "Weight",
            "placeholder" => "Example: 23",
            "type" => "number",
            "class" => "t-input-commodity",
            "is_required" => False,
            "col" => 6,
            "parsley_class" => "t-input-commodity",
            "helper_text" => "Empty weight unit will default to 'kgm'",
        ],
        [
            "name" => "temp_weight_unit",
            "label" => "Weight Unit",
            "placeholder" => "Choose weight unit",
            "type" => "select",
            "options" => [
                [
                    "label" => 'kgm',
                    "value" => 'kgm'
                ],
                [
                    "label" => 'ton',
                    "value" => 'ton'
                ],
            ],
            "class" => "t-input-commodity",
            "is_required" => False,
            "col" => 6,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_detail",
            "label" => "Detail Description",
            "placeholder" => "Example: Fragile goods, require freezer, etc...",
            "type" => "text",
            "class" => "t-input-commodity",
            "is_required" => False,
            "parsley_class" => "t-input-commodity",
        ],
    ];

    /**
     *
     * WAERHOUSE
     *
     */

     /**
      * Manifest Header - Domestic
      */
    public static $warehouse_manifest_header_domestic = [
        [
            "name" => "warehouse",
            "label" => "Warehouse",
            "placeholder" => "",
            "type" => "input",
            "class" => "",
            "is_required" => True,
            "is_readonly" => True,
            "value" => 'HALAL HUB',
            "parsley_class" => "main",
        ],
        [
            "name" => "order_type",
            "label" => "Order Type",
            "placeholder" => "",
            "type" => "input",
            "class" => "",
            "is_required" => True,
            "is_readonly" => True,
            "value" => 'INBOUND',
            "parsley_class" => "main",
            "col" => 6,
        ],
        [
            "name" => "job_type",
            "label" => "Job Type",
            "placeholder" => "",
            "type" => "input",
            "class" => "",
            "is_required" => True,
            "is_readonly" => True,
            "value" => 'DOMESTIC',
            "parsley_class" => "main",
            "col" => 6,
        ],
        [
            "name" => "eta",
            "label" => "ETA",
            "placeholder" => "ETA Date",
            "type" => "date",
            "class" => "",
            "is_required" => True,
            "parsley_class" => "main",
        ],
        [
            "name" => "over_from",
            "label" => "Over From",
            "placeholder" => "Example: NCT/NPCT1",
            "type" => "input",
            "class" => '',
            "is_required" => True,
            "parsley_class" => "main",
            "col" => 6,
        ],
        [
            "name" => "over_to",
            "label" => "Over To",
            "placeholder" => "Example: HLC",
            "type" => "input",
            "class" => '',
            "is_required" => False,
            "parsley_class" => "main",
            "col" => 6,
        ],
        [
            "name" => "vessel",
            "label" => "Vessel",
            "placeholder" => "Example: MAERSK",
            "type" => "input",
            "class" => '',
            "is_required" => False,
            "parsley_class" => "main",
            "col" => 6,
        ],
        [
            "name" => "voyage",
            "label" => "Voyage",
            "placeholder" => "Example: 120S",
            "type" => "input",
            "class" => '',
            "is_required" => False,
            "parsley_class" => "main",
            "col" => 6,
        ],
        [
            "name" => "port_of_loading",
            "label" => "Port Of Loading",
            "placeholder" => "Choose port of loading",
            "type" => "select",
            "class" => "port_select",
            "is_required" => False,
            "parsley_class" => "main",
            "col" => 6,
        ],
        [
            "name" => "port_of_destination",
            "label" => "Port Of Destination",
            "placeholder" => "Choose port of destination",
            "type" => "select",
            "class" => "port_select",
            "is_required" => False,
            "parsley_class" => "main",
            "col" => 6,
        ],
    ];

    /**
     * Warehouse Manifest Header Container Info
     */

    public static $warehouse_manifest_header_container = [
        [
            "name" => "master_bl_no",
            "label" => "Master B/L No.",
            "placeholder" => "Example: 012345678900",
            "type" => "input",
            "class" => '',
            "is_required" => True,
            "parsley_class" => "main",
        ],
        [
            "name" => "container_no",
            "label" => "Container/Batch No.",
            "placeholder" => "Example: MRSK1234567",
            "type" => "input",
            "class" => '',
            "is_required" => True,
            "parsley_class" => "main",
        ],
        [
            "name" => "container_size",
            "label" => "Container Size",
            "placeholder" => "Choose container size",
            "type" => "select",
            "options" => [
                [
                    "label" => '20',
                    "value" => '20'
                ],
                [
                    "label" => '40',
                    "value" => '40'
                ],
                [
                    "label" => '45',
                    "value" => '45'
                ],
            ],
            "class" => "",
            "is_required" => True,
            "col" => 12,
            "parsley_class" => "main",
        ],
    ];

     /**
      * Manifest Header - Export
      */
      public static $warehouse_manifest_header_export = [
        [
            "name" => "warehouse",
            "label" => "Warehouse",
            "placeholder" => "",
            "type" => "input",
            "class" => "",
            "is_required" => True,
            "is_readonly" => True,
            "value" => 'HALAL HUB',
            "parsley_class" => "main",
        ],
        [
            "name" => "order_type",
            "label" => "Order Type",
            "placeholder" => "",
            "type" => "input",
            "class" => "",
            "is_required" => True,
            "is_readonly" => True,
            "value" => 'INBOUND',
            "parsley_class" => "main",
            "col" => 6,
        ],
        [
            "name" => "job_type",
            "label" => "Job Type",
            "placeholder" => "",
            "type" => "input",
            "class" => "",
            "is_required" => True,
            "is_readonly" => True,
            "value" => 'EXPORT',
            "parsley_class" => "main",
            "col" => 6,
        ],
        [
            "name" => "eta",
            "label" => "ETA",
            "placeholder" => "ETA Date",
            "type" => "date",
            "class" => "",
            "is_required" => True,
            "parsley_class" => "main",
        ],
        [
            "name" => "over_from",
            "label" => "Over From",
            "placeholder" => "Example: NCT/NPCT1",
            "type" => "input",
            "class" => '',
            "is_required" => True,
            "parsley_class" => "main",
            "col" => 6,
        ],
        [
            "name" => "over_to",
            "label" => "Over To",
            "placeholder" => "Example: HLC",
            "type" => "input",
            "class" => '',
            "is_required" => False,
            "parsley_class" => "main",
            "col" => 6,
        ],
        [
            "name" => "vessel",
            "label" => "Vessel",
            "placeholder" => "Example: MAERSK",
            "type" => "input",
            "class" => '',
            "is_required" => False,
            "parsley_class" => "main",
            "col" => 6,
        ],
        [
            "name" => "voyage",
            "label" => "Voyage",
            "placeholder" => "Example: 120S",
            "type" => "input",
            "class" => '',
            "is_required" => False,
            "parsley_class" => "main",
            "col" => 6,
        ],
        [
            "name" => "port_of_loading",
            "label" => "Port Of Loading",
            "placeholder" => "Choose port of loading",
            "type" => "select",
            "class" => "port_select",
            "is_required" => False,
            "parsley_class" => "main",
            "col" => 6,
        ],
        [
            "name" => "port_of_destination",
            "label" => "Port Of Destination",
            "placeholder" => "Choose port of destination",
            "type" => "select",
            "class" => "port_select",
            "is_required" => False,
            "parsley_class" => "main",
            "col" => 6,
        ],
    ];

    /**
     * Warehouse Cargo Fields - Domestic
     */
    public static $cargo_warehouse_fields_domestic = [
        [
            "name" => "temp_pos_bl",
            "label" => "POS B/L No.",
            "placeholder" => "Example: 01234567890",
            "type" => "input",
            "class" => "t-input-commodity",
            "is_required" => False,
            "is_readonly" => True,
            "value" => 'AUTO GENERATED',
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_category",
            "label" => "Category",
            "placeholder" => "Choose category",
            "type" => "select",
            "options" => [
                [
                    'label' => 'dummy',
                    'value' => 'dummy',
                ]
            ],
            "class" => "t-input-commodity",
            "is_required" => True,
            "col" => 12,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_product",
            "label" => "Product",
            "placeholder" => "Choose product",
            "type" => "select",
            "options" => [
                [
                    'label' => 'dummy',
                    'value' => 'dummy',
                ]
            ],
            "class" => "t-input-commodity",
            "is_required" => True,
            "col" => 12,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_marking",
            "label" => "Marking",
            "placeholder" => "Example: MNBU0580448",
            "type" => "input",
            "class" => "t-input-commodity",
            "is_required" => True,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_cargo_type",
            "label" => "Cargo Type",
            "placeholder" => "Choose cargo type",
            "type" => "select",
            "options" => [
                [
                    'label' => 'dummy',
                    'value' => 'dummy',
                ]
            ],
            "class" => "t-input-commodity",
            "is_required" => True,
            "col" => 12,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_qty",
            "label" => "Qty",
            "placeholder" => "Ex: 23",
            "type" => "number",
            "class" => "t-input-commodity",
            "is_required" => True,
            "col" => 6,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_packing",
            "label" => "Packing",
            "placeholder" => "Choose packing",
            "type" => "select",
            "options" => [
                [
                    'label' => 'dummy',
                    'value' => 'dummy',
                ]
            ],
            "class" => "t-input-commodity",
            "is_required" => True,
            "col" => 6,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_volume",
            "label" => "Volume",
            "placeholder" => "Ex: 23",
            "type" => "number",
            "class" => "t-input-commodity",
            "is_required" => True,
            "col" => 6,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_volume_unit",
            "label" => "Volume Unit",
            "placeholder" => "",
            "type" => "input",
            "class" => "t-input-commodity",
            "is_required" => True,
            "is_readonly" => True,
            "value" => 'M3',
            "col" => 6,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_weight",
            "label" => "Weight",
            "placeholder" => "Ex: 23",
            "type" => "number",
            "class" => "t-input-commodity",
            "is_required" => True,
            "col" => 6,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_weight_unit",
            "label" => "Weight Unit",
            "placeholder" => "",
            "type" => "input",
            "class" => "t-input-commodity",
            "is_required" => True,
            "is_readonly" => True,
            "value" => 'KGS',
            "col" => 6,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_description",
            "label" => "Cargo Description",
            "placeholder" => "Example: Electronics, etc...",
            "type" => "text",
            "class" => "t-input-commodity",
            "is_required" => True,
            "parsley_class" => "t-input-commodity",
        ],
    ];

    /**
     * Warehouse Cargo Fields - Export
     */
    public static $cargo_warehouse_fields_export = [
        [
            "name" => "temp_pos_bl",
            "label" => "POS B/L No.",
            "placeholder" => "Example: 01234567890",
            "type" => "input",
            "class" => "t-input-commodity",
            "is_required" => False,
            "is_readonly" => True,
            "value" => 'AUTO GENERATED',
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_category",
            "label" => "Category",
            "placeholder" => "Choose category",
            "type" => "select",
            "options" => [
                [
                    'label' => 'dummy',
                    'value' => 'dummy',
                ]
            ],
            "class" => "t-input-commodity",
            "is_required" => True,
            "col" => 12,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_product",
            "label" => "Product",
            "placeholder" => "Choose product",
            "type" => "select",
            "options" => [
                [
                    'label' => 'dummy',
                    'value' => 'dummy',
                ]
            ],
            "class" => "t-input-commodity",
            "is_required" => True,
            "col" => 12,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_marking",
            "label" => "Marking",
            "placeholder" => "Example: MNBU0580448",
            "type" => "input",
            "class" => "t-input-commodity",
            "is_required" => True,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_so_no",
            "label" => "SO No.",
            "placeholder" => "Example: SO0580448",
            "type" => "input",
            "class" => "t-input-commodity",
            "is_required" => True,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_npe_no",
            "label" => "NPE No.",
            "placeholder" => "Example: NPE0580448",
            "type" => "input",
            "class" => "t-input-commodity",
            "is_required" => True,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_po_no",
            "label" => "PO No.",
            "placeholder" => "Example: PO0580448",
            "type" => "input",
            "class" => "t-input-commodity",
            "is_required" => True,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_cargo_type",
            "label" => "Cargo Type",
            "placeholder" => "Choose cargo type",
            "type" => "select",
            "options" => [
                [
                    'label' => 'dummy',
                    'value' => 'dummy',
                ]
            ],
            "class" => "t-input-commodity",
            "is_required" => True,
            "col" => 12,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_qty",
            "label" => "Qty",
            "placeholder" => "Ex: 23",
            "type" => "number",
            "class" => "t-input-commodity",
            "is_required" => True,
            "col" => 6,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_packing",
            "label" => "Packing",
            "placeholder" => "Choose packing",
            "type" => "select",
            "options" => [
                [
                    'label' => 'dummy',
                    'value' => 'dummy',
                ]
            ],
            "class" => "t-input-commodity",
            "is_required" => True,
            "col" => 6,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_volume",
            "label" => "Volume",
            "placeholder" => "Ex: 23",
            "type" => "number",
            "class" => "t-input-commodity",
            "is_required" => True,
            "col" => 6,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_volume_unit",
            "label" => "Volume Unit",
            "placeholder" => "",
            "type" => "input",
            "class" => "t-input-commodity",
            "is_required" => True,
            "is_readonly" => True,
            "value" => 'M3',
            "col" => 6,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_weight",
            "label" => "Weight",
            "placeholder" => "Ex: 23",
            "type" => "number",
            "class" => "t-input-commodity",
            "is_required" => True,
            "col" => 6,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_weight_unit",
            "label" => "Weight Unit",
            "placeholder" => "",
            "type" => "input",
            "class" => "t-input-commodity",
            "is_required" => True,
            "is_readonly" => True,
            "value" => 'KGS',
            "col" => 6,
            "parsley_class" => "t-input-commodity",
        ],
        [
            "name" => "temp_description",
            "label" => "Cargo Description",
            "placeholder" => "Example: Electronics, etc...",
            "type" => "text",
            "class" => "t-input-commodity",
            "is_required" => True,
            "parsley_class" => "t-input-commodity",
        ],
    ];

    /**
     * Yard Container Fields
     */
    public static $container_fields = [
        [
            "name" => "temp_container_number",
            "label" => "Container Number",
            "placeholder" => "Example: MRKU 123456-7",
            "type" => "input",
            "class" => "t-input-containers",
            "is_required" => True,
            "parsley_class" => "t-input-containers",
        ],
        [
            "name" => "temp_container_type",
            "label" => "Type",
            "placeholder" => "Choose cont. type",
            "type" => "select",
            "options" => [
                [
                    "label" => 'DRY',
                    "value" => 'DRY'
                ],
                [
                    "label" => 'REEFER',
                    "value" => 'REEFER'
                ],
                [
                    "label" => 'FLAT RACK',
                    "value" => 'FLAT RACK'
                ],
                [
                    "label" => 'BB (DG)',
                    "value" => 'BB'
                ],
            ],
            "class" => "t-input-containers",
            "is_required" => True,
            "col" => 6,
            "parsley_class" => "t-input-containers",
        ],
        [
            "name" => "temp_container_size",
            "label" => "Size",
            "placeholder" => "Choose container size",
            "type" => "select",
            "options" => [
                [
                    "label" => '20',
                    "value" => '20'
                ],
                [
                    "label" => '40',
                    "value" => '40'
                ],
                [
                    "label" => '45',
                    "value" => '45'
                ],
            ],
            "class" => "t-input-containers",
            "is_required" => True,
            "col" => 6,
            "parsley_class" => "t-input-containers",
        ],
        [
            "name" => "temp_container_status",
            "label" => "Status",
            "placeholder" => "Choose container status",
            "type" => "select",
            "options" => [
                [
                    "label" => 'FULL',
                    "value" => 'FULL'
                ],
                [
                    "label" => 'EMPTY',
                    "value" => 'EMPTY'
                ],
            ],
            "class" => "t-input-containers",
            "is_required" => True,
            "col" => 12,
            "parsley_class" => "t-input-containers",
        ],
    ];
}
