<?php

return [
    'admin' => [

        'catalog' => [
            'products' => [
                'create-success' => 'Produit ajouté avec succès.',
                'delete-success' => 'Produit supprimé avec succès',
                'update-success' => 'Produit mis à jour avec succès.',

                'inventories' => [
                    'update-success' => 'Inventaire mis à jour avec succès.',
                ],

                'mass-operations' => [
                    'delete-success'  => 'Produits sélectionnés supprimés avec succès.',
                    'update-success'  => 'Produits sélectionnés mis à jour avec succès.',
                ],

                'error' => [
                    'configurable-error' => 'Veuillez sélectionner au moins un attribut configurable.',
                ],
            ],

            'categories' => [
                'create-success' => 'Catégorie ajoutée avec succès.',
                'delete-success' => 'Catégorie supprimée avec succès',
                'update-success' => 'Catégorie mise à jour avec succès.',

                'mass-operations' => [
                    'delete-success'  => 'Catégories sélectionnées supprimées avec succès.',
                    'update-success'  => 'Catégories sélectionnées mises à jour avec succès.',
                ],
            ],

            'attributes' => [
                'create-success' => 'Attribut ajouté avec succès.',
                'delete-success' => 'Attribut supprimé avec succès',
                'update-success' => 'Attribut mis à jour avec succès.',

                'error' => [
                    'system-attributes-delete' => 'Impossible de supprimer les attributs système.',
                    'cannot-change-type'       => 'Impossible de modifier le champ de type',

                    'mass-operations' => [
                        'resource-not-found' => 'Attributs sélectionnés non trouvés.',
                    ],
                ],
            ],

            'families'   => [
                'create-success' => 'Famille ajoutée avec succès.',
                'delete-success' => 'Famille supprimée avec succès',
                'update-success' => 'Famille mise à jour avec succès.',

                'error' => [
                    'last-item-delete' => 'Au moins une famille est requise.',
                    'being-used'       => 'Cette famille de ressources est utilisée dans :source.',
                ],
            ],
        ],

        'customers' => [
            'customers' => [
                'create-success' => 'Client ajouté avec succès.',
                'delete-success' => 'Client supprimé avec succès',
                'update-success' => 'Client mis à jour avec succès.',

                'mass-operations' => [
                    'delete-success' => 'Clients sélectionnés supprimés avec succès.',
                    'update-success' => 'Clients sélectionnés mis à jour avec succès.',
                ],

                'error' => [
                    'order-pending-account-delete' => 'Impossible de supprimer le compte des clients car certaines commandes sont en attente ou dans l\'état de traitement.',
                ],

                'notes' => [
                    'note-taken' => 'Note prise.',
                ],
            ],

            'addresses' => [
                'create-success' => 'Adresse ajoutée avec succès.',
                'delete-success' => 'Adresse supprimée avec succès',
                'update-success' => 'Adresse mise à jour avec succès.',

                'mass-operations' => [
                    'delete-success' => 'Adresses sélectionnées supprimées avec succès.',
                ],
            ],

            'groups' => [
                'create-success' => 'Groupe de clients ajouté avec succès.',
                'delete-success' => 'Groupe de clients supprimé avec succès',
                'update-success' => 'Groupe de clients mis à jour avec succès.',

                'error' => [
                    'being-used'           => 'Cette ressource de groupes est utilisée chez les clients.',
                    'default-group-delete' => 'Impossible de supprimer le groupe par défaut.',
                ],
            ],

        ],


        'settings' => [
            'locales' => [
                'create-success' => 'Locale ajoutée avec succès.',
                'delete-success' => 'Locale supprimée avec succès',
                'update-success' => 'Locale mise à jour avec succès.',

                'error' => [
                    'last-item-delete' => 'Au moins une localisation est requise.',
                ],
            ],

            'currencies' => [
                'create-success' => 'Devise ajoutée avec succès.',
                'delete-success' => 'Devise supprimée avec succès',
                'update-success' => 'Devise mise à jour avec succès.',

                'error' => [
                    'last-item-delete' => 'Au moins une devise est requise.',
                ],
            ],

            'exchange-rates' => [
                'create-success' => 'Taux de change ajouté avec succès.',
                'delete-success' => 'Taux de change supprimé avec succès',
                'update-success' => 'Taux de change mis à jour avec succès.',
            ],

            'inventory-sources' => [
                'create-success'   => 'Source d\'inventaire ajoutée avec succès.',
                'delete-success'   => 'Source d\'inventaire supprimée avec succès',
                'update-success'   => 'Source d\'inventaire mise à jour avec succès.',

                'error' => [
                    'last-item-delete' => 'Au moins une source d\'inventaire est requise.',
                ],
            ],

            'taxes' => [
                'tax-rates' => [
                    'create-success' => 'Taux de taxe ajouté avec succès.',
                    'delete-success' => 'Taux de taxe supprimé avec succès',
                    'update-success' => 'Taux de taxe mis à jour avec succès.',
                ],

                'tax-categories' => [
                    'create-success' => 'Catégorie de taxe ajoutée avec succès.',
                    'delete-success' => 'Catégorie de taxe supprimée avec succès',
                    'update-success' => 'Catégorie de taxe mise à jour avec succès.',
                ],
            ],

            'channels' => [
                'create-success' => 'Canal ajouté avec succès.',
                'delete-success' => 'Canal supprimé avec succès',
                'update-success' => 'Canal mis à jour avec succès.',

                'error' => [
                    'last-item-delete' => 'Au moins un canal est requis.',
                ],
            ],

            'users' => [
                'create-success' => 'Utilisateur ajouté avec succès.',
                'delete-success' => 'Utilisateur supprimé avec succès',
                'update-success' => 'Utilisateur mis à jour avec succès.',

                'error' => [
                    'cannot-change-column' => 'Impossible de modifier les utilisateurs.',
                    'last-item-delete'     => 'Au moins un utilisateur est requis.',
                ],
            ],

            'roles' => [
                'create-success' => 'Rôle ajouté avec succès.',
                'delete-success' => 'Rôle supprimé avec succès',
                'update-success' => 'Rôle mis à jour avec succès.',

                'error' => [
                    'being-used'       => 'Cette ressource de rôles est utilisée chez l\'utilisateur administrateur.',
                    'last-item-delete' => 'Au moins un rôle est requis.',
                ],
            ],

        ],

        'configuration' => [
            'create-success' => 'Configuration ajoutée avec succès.',
            'delete-success' => 'Configuration supprimée avec succès',
            'update-success' => 'Configuration mise à jour avec succès.',
        ],

        'account' => [
            'create-success'     => 'Compte ajouté avec succès.',
            'delete-success'     => 'Compte supprimé avec succès',
            'logged-in-success'  => 'Connecté avec succès.',
            'logged-out-success' => 'Déconnecté avec succès.',
            'update-success'     => 'Compte mis à jour avec succès.',

            'error' => [
                'credential-error'  => 'Les informations d\'identification fournies sont incorrectes.',
                'invalid'           => 'E-mail ou mot de passe invalide',
                'password-mismatch' => 'Le mot de passe actuel ne correspond pas.',
            ],
        ],
    ],
];
