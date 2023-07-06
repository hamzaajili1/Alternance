<?php

namespace App\Validator;

use App\Entity\Chantier;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class DateChantierValidator
 * @package App\Validator
 */
class DateChantierValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint DateChantier */
        if (!$value)
            $this->context->buildViolation($constraint->messageForNull)
                ->addViolation();
        if ($value instanceof Chantier) {
            if ($this->context->getRoot()->getData()->getDate() < $value->getDateDebut())
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $value->getDateDebut()->format('d.m.Y'))
                    ->addViolation();
        }
    }
}