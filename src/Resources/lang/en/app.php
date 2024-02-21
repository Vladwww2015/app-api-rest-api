<?php

return [
    'admin' => [

        'catalog' => [
            'products' => [
                'create-success' => 'Product have been successfully added.',
                'delete-success' => 'Product successfully deleted',
                'update-success' => 'Product updated successfully.',

                'inventories' => [
                    'update-success' => 'Inventory updated successfully.',
                ],

                'mass-operations' => [
                    'delete-success'  => 'Selected Products successfully deleted.',
                    'update-success'  => 'Selected Products successfully updated.',
                ],

                'error' => [
                    'configurable-error' => 'Please select at least one configurable attribute.',
                ],
            ],

            'categories' => [
                'create-success' => 'Category have been successfully added.',
                'delete-success' => 'Category successfully deleted',
                'update-success' => 'Category updated successfully.',

                'mass-operations' => [
                    'delete-success'  => 'Selected Categories successfully deleted.',
                    'update-success'  => 'Selected Categories updated successfully.',
                ],
            ],

            'attributes' => [
                'create-success' => 'Attribute have been successfully added.',
                'delete-success' => 'Attribute successfully deleted',
                'update-success' => 'Attribute updated successfully.',

                'error' => [
                    'system-attributes-delete' => 'Cannot delete the system attributes.',
                    'cannot-change-type'       => 'Cannot Change type field',

                    'mass-operations' => [
                        'resource-not-found' => 'Selected attributes not found.',
                    ],
                ],
            ],

            'families'   => [
                'create-success' => 'Family have been successfully added.',
                'delete-success' => 'Family successfully deleted',
                'update-success' => 'Family updated successfully.',

                'error' => [
                    'last-item-delete' => 'At least one families is required.',
                    'being-used'       => 'This resource families is getting used in :source.',
                ],
            ],
        ],

        'customers' => [
            'customers' => [
                'create-success' => 'Customer have been successfully added.',
                'delete-success' => 'Customer successfully deleted',
                'update-success' => 'Customer updated successfully.',

                'mass-operations' => [
                    'delete-success' => 'Selected customers successfully deleted.',
                    'update-success' => 'Selected customers successfully updated.',
                ],

                'error' => [
                    'order-pending-account-delete' => 'Cannot delete customers account because some orders are pending or in processing state.',
                ],

                'notes' => [
                    'note-taken' => 'Note taken.',
                ],
            ],

            'addresses' => [
                'create-success' => 'Address have been successfully added.',
                'delete-success' => 'Address successfully deleted',
                'update-success' => 'Address updated successfully.',

                'mass-operations' => [
                    'delete-success' => 'Selected addresses successfully deleted.',
                ],
            ],

            'groups' => [
                'create-success' => 'Customer group have been successfully added.',
                'delete-success' => 'Customer group successfully deleted',
                'update-success' => 'Customer group updated successfully.',

                'error' => [
                    'being-used'           => 'This resource groups is getting used in Customers.',
                    'default-group-delete' => 'Cannot delete the default group.',
                ],
            ],
        ],

        'settings' => [
            'locales' => [
                'create-success' => 'Locale have been successfully added.',
                'delete-success' => 'Locale successfully deleted',
                'update-success' => 'Locale updated successfully.',

                'error' => [
                    'last-item-delete' => 'At least one locales is required.',
                ],
            ],

            'currencies' => [
                'create-success' => 'Currency have been successfully added.',
                'delete-success' => 'Currency successfully deleted',
                'update-success' => 'Currency updated successfully.',

                'error' => [
                    'last-item-delete' => 'At least one currencies is required.',
                ],
            ],

            'exchange-rates' => [
                'create-success' => 'Exchange Rate have been successfully added.',
                'delete-success' => 'Exchange Rate successfully deleted',
                'update-success' => 'Exchange Rate updated successfully.',
            ],

            'inventory-sources' => [
                'create-success'   => 'Inventory Source have been successfully added.',
                'delete-success'   => 'Inventory Source successfully deleted',
                'update-success'   => 'Inventory Source updated successfully.',

                'error' => [
                    'last-item-delete' => 'At least one inventory sources is required.',
                ],
            ],

            'taxes' => [
                'tax-rates' => [
                    'create-success' => 'Tax Rate have been successfully added.',
                    'delete-success' => 'Tax Rate successfully deleted',
                    'update-success' => 'Tax Rate updated successfully.',
                ],

                'tax-categories' => [
                    'create-success' => 'Tax Category have been successfully added.',
                    'delete-success' => 'Tax Category successfully deleted',
                    'update-success' => 'Tax Category updated successfully.',
                ],
            ],

            'channels' => [
                'create-success' => 'Channel have been successfully added.',
                'delete-success' => 'Channel successfully deleted',
                'update-success' => 'Channel updated successfully.',

                'error' => [
                    'last-item-delete' => 'At least one channels is required.',
                ],
            ],

            'users' => [
                'create-success' => 'User have been successfully added.',
                'delete-success' => 'User successfully deleted',
                'update-success' => 'User updated successfully.',

                'error' => [
                    'cannot-change-column' => 'Cannot change the users.',
                    'last-item-delete'     => 'At least one users is required.',
                ],
            ],

            'roles' => [
                'create-success' => 'Role have been successfully added.',
                'delete-success' => 'Role successfully deleted',
                'update-success' => 'Role updated successfully.',

                'error' => [
                    'being-used'       => 'This resource roles is getting used in admin user.',
                    'last-item-delete' => 'At least one roles is required.',
                ],
            ],
        ],

        'configuration' => [
            'create-success' => 'Configuration have been successfully added.',
            'delete-success' => 'Configuration successfully deleted',
            'update-success' => 'Configuration updated successfully.',
        ],

        'account' => [
            'create-success'     => 'Account have been successfully added.',
            'delete-success'     => 'Account successfully deleted',
            'logged-in-success'  => 'Logged in successfully.',
            'logged-out-success' => 'Logged out successfully.',
            'update-success'     => 'Account updated successfully.',

            'error' => [
                'credential-error'  => 'The provided credentials are incorrect.',
                'invalid'           => 'Invalid Email or Password',
                'password-mismatch' => 'Current password does not match.',
            ],
        ],
    ]
];
