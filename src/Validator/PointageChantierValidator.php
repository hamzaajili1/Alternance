<?php

namespace App\Validator;

use App\Entity\Pointage;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class PointageChantierValidator
 * @package App\Validator
 */
class PointageChantierValidator extends ConstraintValidator
{
    /**
     * @param $value
     * @param Pointage $pointage
     * @return bool
     */
    public function isChantierValide($value, Pointage $pointage): bool
    {
        if (!$pointage->getUtilisateur()) {
            return true;
        }

        /* @var $pointagesUtilisateur Pointage[] */
        foreach ($pointage->getUtilisateur()->getPointagesJour($value) as $pointageUtilisateur) {
            if ($pointage->getChantier() === $pointageUtilisateur->getChantier()) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint PointageChantier */
        $pointage = $this->context->getRoot()->getData();

        if (!$pointage instanceof Pointage) {
            return;
        }

        $validaton = $this->isChantierValide($value, $pointage);

        if (!$value) {
            $this->context->buildViolation($constraint->messageForNull)
                ->addViolation();
        }

        if (!$validaton) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value->format('d.m.Y'))
                ->addViolation();
        }
    }
}
