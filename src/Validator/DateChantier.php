<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DateChantier extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'Vous ne pouvez pas pointer sur ce chantier avant le {{ value }}';
    public $messageForNull = 'Vous devez selectionner un chantier';
}