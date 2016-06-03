<?php

namespace BricksCommon\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Form;
use Zend\Paginator\Paginator;
use BricksCommon\Exception\MissingImplementationException;

class CrudController extends AbstractActionController
{
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
            $form->setData($this->getPost());
            if ($form->validate()) {
                $this->save($form->getData());
                return $this->getListRedirect();
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
            $form->setData($this->getPost());
            if ($form->validate()) {
                $this->save($form->getData(), $id);
                return $this->getListRedirect();
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
            $form->setData($this->getPost());
            if ($form->validate()) {
                $this->deleteById($id);
                return $this->getListRedirect();
            }
        }
        return [
            'form' => $form
        ];
    }
    
    protected function getDeleteForm()
    {
        return new \BricksCommon\Form\DeleteForm();
    }

    protected function getForm()
    {
        throw new Exception('Missing implementation for ' . __METHOD__ . ' in ' . self::class);
    }

    protected function getListRedirect()
    {
        throw new Exception('Missing implementation for ' . __METHOD__ . ' in ' . self::class);
    }

    protected function getById($id)
    {
        throw new Exception('Missing implementation for ' . __METHOD__ . ' in ' . self::class);
    }

    protected function getListPaginator()
    {
        throw new Exception('Missing implementation for ' . __METHOD__ . ' in ' . self::class);
    }

    /**
     * save without $id => INSERT
     * save with $id => UPDATE
     */
    protected function save($data, $id = null)
    {
        throw new Exception('Missing implementation for ' . __METHOD__ . ' in ' . self::class);
    }

    protected function deleteById($id)
    {
        throw new Exception('Missing implementation for ' . __METHOD__ . ' in ' . self::class);
    }
}
