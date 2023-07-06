<?php

namespace App\Validator;

use App\Entity\Pointage;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class TempsTravailValidator
 * @package App\Validator
 */
class TempsTravailValidator extends ConstraintValidator
{
    const HEURE_MAX = 35;

    /**
     * @param $value
     * @param Pointage $pointage
     * @return bool
     */
    private function isValidWorkingTime($value, Pointage $pointage)
    {
        if (!$pointage->getUtilisateur()) {
            return true;
        }

        $totalHeureSemaine = 0;
        $date = $pointage->getDate()->format('Y-m-d');

        foreach ($pointage->getUtilisateur()->getPointagesSemaine($date) as $pointageUtilisateur) {
            if ($pointageUtilisateur !== $pointage) {
                $totalHeureSemaine += $pointageUtilisateur->getDuree();
            }
        }

        $tempsTravail = $totalHeureSemaine + $value;
        return $value && $tempsTravail <= self::HEURE_MAX;
    }

    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint TempsTravail */
        $pointage = $this->context->getRoot()->getData();

        if (!$pointage instanceof Pointage) {
            return;
        }

        $validation = $this->isValidWorkingTime($value, $pointage);

        if (!$value) {
            $this->context->buildViolation($constraint->messageForNull)
                ->addViolation();
        }

        if (!$validation) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', self::HEURE_MAX)
                ->addViolation();
        }
    }
}
