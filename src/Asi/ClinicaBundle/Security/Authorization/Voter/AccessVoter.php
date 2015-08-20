<?php
namespace Asi\ClinicaBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AccessVoter implements VoterInterface
{
    const VIEW = 'view';
    const CREATE = 'create';
    const DELETE = 'delete';
    const EDIT = 'edit';

    public function supportsAttribute($attribute)
    {
        return in_array($attribute, array(
            self::VIEW,
            self::CREATE,
            self::DELETE,
            self::EDIT,
        ));
    }

    public function supportsClass($class)
    {   
        //Se supone que este validador es generico, asi que no vamos a validar class
        return TRUE;
    }

    /**
     * @var {ObjectInstance} $object
     */
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        // check if class of this object is supported by this voter
        if (!$this->supportsClass(get_class($object))) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        // check if the voter is used correct, only allow one attribute
        // this isn't a requirement, it's just one easy way for you to
        // design your voter
        if (1 !== count($attributes)) {
            throw new \InvalidArgumentException(
                'Only one attribute is allowed for VIEW or EDIT'
            );
        }

        // set the attribute to check against
        $attribute = $attributes[0];

        // check if the given attribute is covered by this voter
        if (!$this->supportsAttribute($attribute)) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        // get current logged in user
        $user = $token->getUser();

        // make sure there is a user object (i.e. that the user is logged in)
        if (!$user instanceof UserInterface) {
            return VoterInterface::ACCESS_DENIED;
        }

        switch($attribute) {
            case self::VIEW:
                
                // the data object could have for example a method isPrivate()
                // which checks the Boolean attribute $private
                if (method_exists($object, 'isPrivate')){
                    if (!$object->isPrivate()) {
                        return VoterInterface::ACCESS_GRANTED;
                    }
                }else{
                    return VoterInterface::ACCESS_GRANTED;
                }
                
                break;

            case self::EDIT:
                // we assume that our data object has a method getOwner() to
                // get the current owner user entity for this data object
                if ($user->getId() === $object->getOwner()->getId()) {
                    return VoterInterface::ACCESS_GRANTED;
                }
                break;
        }

        return VoterInterface::ACCESS_DENIED;
    }
}
