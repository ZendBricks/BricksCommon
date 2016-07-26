<?php

namespace ZendBricks\BricksCommon\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use ZendBricks\BricksCommon\Exception\MissingImplementationException;
use ZendBricks\BricksCommon\Form\DeleteForm;

class CrudController extends AbstractActionController
{
    const ITEMS_PER_PAGE = 20;
    
    public function listAction()
    {
        $page = $this->params()->fromRoute('page');
        $paginator = $this->getListPaginator();
        $paginator->setCurrentPageNumber($page);
        return [
            'paginator' => $paginator
        ];
    }

    public function createAction()
    {
        $form = $this->getForm();
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $formData = $form->getData();
                if ($this->save($formData)) {
                    $this->onCreateSuccess($formData);
                    $this->flashMessenger()->addSuccessMessage('save.success');
                    return $this->getListRedirect();
                } else {
                    $this->flashMessenger()->addErrorMessage('save.failed');
                }
            }
        }
        return [
            'form' => $form
        ];
    }

    public function showAction()
    {
        $id = $this->params()->fromRoute('id');
        return $this->getById($id);
    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('id');
        $form = $this->getForm();
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $formData = $form->getData();
                if ($this->save($formData, $id)) {
                    $this->onEditSuccess($formData);
                    $this->flashMessenger()->addSuccessMessage('edit.success');
                    return $this->getListRedirect();
                } else {
                    $this->flashMessenger()->addErrorMessage('edit.failed');
                }
            }
        } else {
            $formData = $this->getData($id);
            if ($formData) {
                $form->setData($formData);
            } else {
                $this->flashMessenger()->addErrorMessage('not.found');
            }
        }
        return [
            'form' => $form
        ];
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        $form = $this->getDeleteForm();
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                if ($this->deleteById($id)) {
                    $this->onDeleteSuccess();
                    $this->flashMessenger()->addSuccessMessage('delete.success');
                    return $this->getListRedirect();
                } else {
                    $this->flashMessenger()->addErrorMessage('delete.failed');
                }
            }
        }
        return [
            'form' => $form
        ];
    }
    
    protected function getDeleteForm()
    {
        return new DeleteForm();
    }

    protected function getForm()
    {
        throw new MissingImplementationException('Missing implementation for ' . __METHOD__ . ' in ' . self::class);
    }

    protected function getListRedirect()
    {
        throw new MissingImplementationException('Missing implementation for ' . __METHOD__ . ' in ' . self::class);
    }

    protected function getById($id)
    {
        throw new MissingImplementationException('Missing implementation for ' . __METHOD__ . ' in ' . self::class);
    }

    /**
     * @return \Zend\Paginator\Paginator
     */
    protected function getListPaginator()
    {
        throw new MissingImplementationException('Missing implementation for ' . __METHOD__ . ' in ' . self::class);
    }

    /**
     * save without $id => INSERT
     * save with $id => UPDATE
     */
    protected function save($data, $id = null)
    {
        throw new MissingImplementationException('Missing implementation for ' . __METHOD__ . ' in ' . self::class);
    }
    
    protected function getData($id)
    {
        throw new MissingImplementationException('Missing implementation for ' . __METHOD__ . ' in ' . self::class);
    }

    protected function deleteById($id)
    {
        throw new MissingImplementationException('Missing implementation for ' . __METHOD__ . ' in ' . self::class);
    }
    
    /**
     * Event to override
     */
    protected function onCreateSuccess(array $formData) {
        
    }
    
    /**
     * Event to override
     */
    protected function onEditSuccess(array $formData) {
        
    }
    
    /**
     * Event to override
     */
    protected function onDeleteSuccess() {
        
    }
}
