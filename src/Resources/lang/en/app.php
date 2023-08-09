<?php

return [
    'catalog' => [
        'products' => [
            'configurable-error' => 'Please select atleast one configurable attribute.',
        ],
    ],

    'customers' => [
        'note-cannot-taken' => 'Note cannot be taken.',
        'note-taken'        => 'Note taken.',
        'address-deleted'   => 'Address Deleted Successfully.',
    ],

    'common-response' => [
        'success' => [
            'add'    => ':name added successfully.',
            'cancel' => ':name canceled successfully.',
            'create' => ':name created successfully.',
            'delete' => ':name deleted successfully.',
            'update' => ':name updated successfully.',
            'upload' => ':name uploaded successfully.',

            'mass-operations' => [
                'delete'  => 'Selected :name successfully deleted.',
                'partial' => 'Some actions were not performed due to restricted system constraints on :name.',
                'update'  => 'Selected :name successfully updated.',
            ],
        ],

        'error' => [
            'already-taken'                => 'The :name has already been taken.',
            'base-currency-delete'         => 'This currency is set as channel base currency so it can not be deleted.',
            'being-used'                   => 'This resource :name is getting used in :source.',
            'cannot-change-column'         => 'Cannot change the :name.',
            'default-group-delete'         => 'Cannot delete the default group.',
            'delete-failed'                => 'Error encountered while deleting :name.',
            'last-item-delete'             => 'At least one :name is required.',
            'not-authorized'               => 'Not Authorized',
            'order-pending-account-delete' => 'Cannot delete :name account because some orders are pending or in processing state.',
            'password-mismatch'            => 'Current password does not match.',
            'root-category-delete'         => 'Cannot delete the root category.',
            'security-warning'             => 'Suspicious activity found!',
            'something-went-wrong'         => 'Something went wrong!',
            'system-attribute-delete'      => 'Cannot delete the system attribute.',

            'mass-operations' => [
                'resource-not-found' => 'Selected :name not found.',
            ],
        ],
    ],
];
