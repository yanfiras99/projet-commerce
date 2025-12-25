<?php

return [
    // Devise affichée par le service de formatage
    'devise' => env('TARIFICATION_DEVISE', 'TND'),

    // Taux de TVA (ex : 0.19 = 19%)
    'TVA' => env('TARIFICATION_TVA', 0.19),

];
