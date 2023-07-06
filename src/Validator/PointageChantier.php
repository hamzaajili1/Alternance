<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PointageChantier extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'Cette utilisateur à déjà pointé sur ce chantier le {{ value }}';
    public $messageForNull = 'Vous devez saisir une date';
}