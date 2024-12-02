<?php
/*------------------------------------------------------------------------------
  $Id$

  AbanteCart, Ideal OpenSource Ecommerce Solution
  http://www.AbanteCart.com

  Copyright © 2011-2020 Belavier Commerce LLC

  This source file is subject to Open Software License (OSL 3.0)
  License details is bundled with this package in the file LICENSE.txt.
  It is also available at this URL:
  <http://www.opensource.org/licenses/OSL-3.0>

 UPGRADE NOTE:
   Do not edit or add to this file if you wish to upgrade AbanteCart to newer
   versions in the future. If you wish to customize AbanteCart for your
   needs please refer to http://www.AbanteCart.com for more information.
------------------------------------------------------------------------------*/
if (!defined('DIR_CORE') || !IS_ADMIN) {
    header('Location: static_pages/');
}

class ControllerPagesLocalisationWeightClass extends AController
{
    public $data = array();
    public $error = array();

    public function main()
    {
        //init controller data
        $this->extensions->hk_InitData($this, __FUNCTION__);

        $this->document->setTitle($this->language->get('heading_title'));

        $this->view->assign('error_warning', $this->error['warning']);
        $this->view->assign('success', $this->session->data['success']);
        if (isset($this->session->data['success'])) {
            unset($this->session->data['success']);
        }

        $this->document->initBreadcrumb(array(
            'href'      => $this->html->getSecureURL('index/home'),
            'text'      => $this->language->get('text_home'),
            'separator' => false,
        ));
        $this->document->addBreadcrumb(array(
            'href'      => $this->html->getSecureURL('localisation/weight_class'),
            'text'      => $this->language->get('heading_title'),
            'separator' => ' :: ',
            'current'   => true,
        ));

        $grid_settings = array(
            'table_id'       => 'weight_grid',
            'url'            => $this->html->getSecureURL('listing_grid/weight_class'),
            'editurl'        => $this->html->getSecureURL('listing_grid/weight_class/update'),
            'update_field'   => $this->html->getSecureURL('listing_grid/weight_class/update_field'),
            'sortname'       => 'title',
            'sortorder'      => 'asc',
            'columns_search' => false,
            'actions'        => array(
                'edit'   => array(
                    'text' => $this->language->get('text_edit'),
                    'href' => $this->html->getSecureURL('localisation/weight_class/update', '&weight_class_id=%ID%'),
                ),
                'save'   => array(
                    'text' => $this->language->get('button_save'),
                ),
                'delete' => array(
                    'text' => $this->language->get('button_delete'),
                ),
            ),
        );

        $grid_settings['colNames'] = array(
            $this->language->get('column_title'),
            $this->language->get('column_unit'),
            $this->language->get('column_value'),
            $this->language->get('column_iso_code'),
        );
        $grid_settings['colModel'] = array(
            array(
                'name'  => 'title',
                'index' => 'title',
                'align' => 'left',
            ),
            array(
                'name'  => 'unit',
                'index' => 'unit',
                'align' => 'center',
            ),
            array(
                'name'  => 'value',
                'index' => 'value',
                'align' => 'center',
            ),
            array(
                'name'  => 'iso_code',
                'index' => 'iso_code',
                'align' => 'center',
            ),
        );

        $grid = $this->dispatch('common/listing_grid', array($grid_settings));
        $this->view->assign('listing_grid', $grid->dispatchGetOutput());

        $this->view->assign('insert', $this->html->getSecureURL('localisation/weight_class/insert'));
        $this->view->assign('form_language_switch', $this->html->getContentLanguageSwitcher());
        $this->view->assign('help_url', $this->gen_help_url('weight_class_listing'));

        $this->processTemplate('pages/localisation/weight_class_list.tpl');

        //update controller data
        $this->extensions->hk_UpdateData($this, __FUNCTION__);
    }

    public function insert()
    {

        //init controller data
        $this->extensions->hk_InitData($this, __FUNCTION__);

        $this->document->setTitle($this->language->get('heading_title'));

        if ($this->request->is_POST() && $this->_validateForm()) {
            $weight_class_id = $this->model_localisation_weight_class->addWeightClass($this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            redirect($this->html->getSecureURL('localisation/weight_class/update', '&weight_class_id='.$weight_class_id));
        }
        $this->_getForm();

        //update controller data
        $this->extensions->hk_UpdateData($this, __FUNCTION__);
    }

    public function update()
    {

        //init controller data
        $this->extensions->hk_InitData($this, __FUNCTION__);

        $this->view->assign('success', $this->session->data['success']);
        if (isset($this->session->data['success'])) {
            unset($this->session->data['success']);
        }

        $this->document->setTitle($this->language->get('heading_title'));

        if ($this->request->is_POST() && $this->_validateForm()) {
            $this->model_localisation_weight_class->editWeightClass($this->request->get['weight_class_id'], $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            redirect($this->html->getSecureURL('localisation/weight_class/update', '&weight_class_id='.$this->request->get['weight_class_id']));
        }
        $this->_getForm();

        //update controller data
        $this->extensions->hk_UpdateData($this, __FUNCTION__);
    }

    private function _getForm()
    {

        $this->data = array();
        $this->data['error'] = $this->error;
        $this->data['cancel'] = $this->html->getSecureURL('localisation/weight_class');

        $this->document->initBreadcrumb(array(
            'href'      => $this->html->getSecureURL('index/home'),
            'text'      => $this->language->get('text_home'),
            'separator' => false,
        ));
        $this->document->addBreadcrumb(array(
            'href'      => $this->html->getSecureURL('localisation/weight_class'),
            'text'      => $this->language->get('heading_title'),
            'separator' => ' :: ',
        ));

        if (isset($this->request->get['weight_class_id']) && $this->request->is_GET()) {
            $weight_class_info = $this->model_localisation_weight_class->getWeightClass($this->request->get['weight_class_id']);
        }

        if (isset($this->request->post['weight_class_description'])) {
            $this->data['weight_class_description'] = $this->request->post['weight_class_description'];
        } elseif (isset($this->request->get['weight_class_id'])) {
            $this->data['weight_class_description'] = $this->model_localisation_weight_class->getWeightClassDescriptions($this->request->get['weight_class_id']);
        } else {
            $this->data['weight_class_description'] = array();
        }

        if (isset($this->request->post['value'])) {
            $this->data['value'] = $this->request->post['value'];
        } elseif (isset($weight_class_info)) {
            $this->data['value'] = $weight_class_info['value'];
        } else {
            $this->data['value'] = '';
        }

        if (isset($this->request->post['iso_code'])) {
            $this->data['iso_code'] = $this->request->post['iso_code'];
        } elseif (isset($weight_class_info)) {
            $this->data['iso_code'] = $weight_class_info['iso_code'];
        } else {
            $this->data['iso_code'] = '';
        }

        if (!isset($this->request->get['weight_class_id'])) {
            $this->data['action'] = $this->html->getSecureURL('localisation/weight_class/insert');
            $this->data['heading_title'] = $this->language->get('text_insert').$this->language->get('text_class');
            $this->data['update'] = '';
            $form = new AForm('ST');
        } else {
            $this->data['action'] = $this->html->getSecureURL('localisation/weight_class/update', '&weight_class_id='.$this->request->get['weight_class_id']);
            $this->data['heading_title'] = $this->language->get('text_edit').$this->language->get('text_class');
            $this->data['update'] = $this->html->getSecureURL('listing_grid/weight_class/update_field', '&id='.$this->request->get['weight_class_id']);
            $form = new AForm('HS');
            $a_weight = new AWeight($this->registry);
            $is_predefined = in_array($this->request->get['weight_class_id'], $a_weight->predefined_weight_ids) ? true : false;
        }

        $this->document->addBreadcrumb(array(
            'href'      => $this->data['action'],
            'text'      => $this->data['heading_title'],
            'separator' => ' :: ',
            'current'   => true,
        ));

        $form->setForm(array(
            'form_name' => 'editFrm',
            'update'    => $this->data['update'],
        ));

        $this->data['form']['id'] = 'editFrm';
        $this->data['form']['form_open'] = $form->getFieldHtml(array(
            'type'   => 'form',
            'name'   => 'editFrm',
            'action' => $this->data['action'],
            'attr'   => 'data-confirm-exit="true" class="aform form-horizontal"',
        ));
        $this->data['form']['submit'] = $form->getFieldHtml(array(
            'type'  => 'button',
            'name'  => 'submit',
            'text'  => $this->language->get('button_save'),
            'style' => 'button1',
        ));
        $this->data['form']['cancel'] = $form->getFieldHtml(array(
            'type'  => 'button',
            'name'  => 'cancel',
            'text'  => $this->language->get('button_cancel'),
            'style' => 'button2',
        ));

        $content_language_id = $this->language->getContentLanguageID();

        $this->data['form']['fields']['title'] = $form->getFieldHtml(array(
            'type'         => 'input',
            'name'         => 'weight_class_description['.$content_language_id.'][title]',
            'value'        => $this->data['weight_class_description'][$content_language_id]['title'],
            'required'     => true,
            'style'        => 'large-field',
            'multilingual' => true,
        ));
        $this->data['form']['fields']['unit'] = $form->getFieldHtml(array(
            'type'         => 'input',
            'name'         => 'weight_class_description['.$content_language_id.'][unit]',
            'value'        => $this->data['weight_class_description'][$content_language_id]['unit'],
            'required'     => true,
            'style'        => 'large-field',
            'multilingual' => true,
        ));
        $this->data['form']['fields']['iso_code'] = $form->getFieldHtml(array(
            'type'     => 'input',
            'name'     => 'iso_code',
            'value'    => $this->data['iso_code'],
            'required' => true,
            'attr'     => 'maxlength="4" '.($is_predefined ? 'readonly' : ''),
            'style'    => 'tiny-field',
        ));
        $this->data['form']['fields']['value'] = $form->getFieldHtml(array(
            'type'  => 'input',
            'name'  => 'value',
            'value' => $this->data['value'],
            'attr'  => $is_predefined ? 'readonly' : '',
        ));

        $this->view->batchAssign($this->data);
        $this->view->assign('form_language_switch', $this->html->getContentLanguageSwitcher());
        $this->view->assign('language_id', $content_language_id);
        $this->view->assign('help_url', $this->gen_help_url('weight_class_edit'));

        $this->processTemplate('pages/localisation/weight_class_form.tpl');
    }

    private function _validateForm()
    {
        if (!$this->user->canModify('localisation/weight_class')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['weight_class_description'] as $language_id => $value) {
            if (mb_strlen($value['title']) < 2 || mb_strlen($value['title']) > 32) {
                $this->error['title'] = $this->language->get('error_title');
            }
            if ((!$value['unit']) || mb_strlen($value['unit']) > 4) {
                $this->error['unit'] = $this->language->get('error_unit');
            }
        }

        $iso_code = strtoupper(preg_replace('/[^a-z]/i', '', $this->request->post['iso_code']));
        if ((!$iso_code) || strlen($iso_code) != 4) {
            $this->error['iso_code'] = $this->language->get('error_iso_code');
        } //check for uniqueness
        else {
            $weight = $this->model_localisation_weight_class->getWeightClassByCode($iso_code);
            $weight_class_id = (int)$this->request->get['weight_class_id'];
            if ($weight) {
                if (!$weight_class_id
                    || ($weight_class_id && $weight['weight_class_id'] != $weight_class_id)
                ) {
                    $this->error['iso_code'] = $this->language->get('error_iso_code');
                }
            }
        }

        $this->extensions->hk_ValidateData($this);

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

}
