<?php

namespace Ise\Admin\Service;

use Ise\Bread\Service\AbstractService;
use ZfcRbac\Service\AuthorizationServiceAwareInterface;
use ZfcRbac\Service\AuthorizationServiceAwareTrait;

/**
 * @SuppressWarnings(PHPMD.ShortVariableName)
 */
class UserService extends AbstractService implements AuthorizationServiceAwareInterface
{

    use AuthorizationServiceAwareTrait;

    /**
     * @var string
     */
    protected $entityClass = 'Ise\Admin\Entity\User';

    /**
     * @var string
     */
    protected $mapperClass = 'Ise\Admin\Mapper\User';

    /**
     * @var string[]
     */
    protected $form = [
        'add'     => 'Ise\Admin\Form\User\Add',
        'edit'    => 'Ise\Admin\Form\User\Edit',
        'delete'  => 'Ise\Admin\Form\User\Delete',
        'enable'  => 'Ise\Admin\Form\User\Enable',
        'disable' => 'Ise\Admin\Form\User\Disable',
        'ban'     => 'Ise\Admin\Form\User\Ban',
        'unban'   => 'Ise\Admin\Form\User\Delete',
    ];

    public function ban(array $data)
    {
        // Check for current user
        if (!$this->getAuthorizationService()->isGranted('notCurrentUser')) {
            $form = $this->getForm('ban');
            $this->addFormMessage($form, [
                'buttons' => [
                    'submit' => [
                        'You can not ban your own user.'
                    ]
                ]
            ]);
            return false;
        }

        // Validate form
        $form = $this->validateForm('ban', $data);
        if (!$form) {
            return false;
        }

        // Get entity
        $validEntity = $form->getData();
        $validEntity->setBanned(true);

        // Trigger event
        $this->getEventManager()->trigger('ban', $this, [
            'entity' => $validEntity,
            'form'   => $form,
        ]);
        $result = $this->getMapper()->edit($validEntity);
        $this->getEventManager()->trigger('ban', $this, [
            'entity' => $validEntity,
            'form'   => $form,
        ]);

        return $result;
    }

    public function unban(array $data)
    {
        // Check for current user
        if (!$this->getAuthorizationService()->isGranted('notCurrentUser')) {
            $form = $this->getForm('unban');
            $this->addFormMessage($form, 'You can not unban your own user.');
            return false;
        }

        // Validate form
        $form = $this->validateForm('unban', $data);
        if (!$form) {
            return false;
        }

        // Get entity
        $validEntity = $form->getData();
        $validEntity->setBanned(false);

        // Trigger event
        $this->getEventManager()->trigger('unban', $this, [
            'entity' => $validEntity,
            'form'   => $form,
        ]);
        $result = $this->getMapper()->edit($validEntity);
        $this->getEventManager()->trigger('unban', $this, [
            'entity' => $validEntity,
            'form'   => $form,
        ]);

        return $result;
    }
}
