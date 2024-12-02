<?php
/*------------------------------------------------------------------------------
  $Id$

  AbanteCart, Ideal OpenSource Ecommerce Solution
  http://www.AbanteCart.com

  Copyright © 2011-2021 Belavier Commerce LLC

  This source file is subject to Open Software License (OSL 3.0)
  License details is bundled with this package in the file LICENSE.txt.
  It is also available at this URL:
  <http://www.opensource.org/licenses/OSL-3.0>

 UPGRADE NOTE:
   Do not edit or add to this file if you wish to upgrade AbanteCart to newer
   versions in the future. If you wish to customize AbanteCart for your
   needs please refer to http://www.AbanteCart.com for more information.
------------------------------------------------------------------------------*/

class ControllerResponsesListingGridCustomerTransaction extends AController
{
    public $error = [];
    public function main()
    {
        //init controller data
        $this->extensions->hk_InitData($this, __FUNCTION__);

        $this->loadLanguage('sale/customer');
        $this->loadModel('sale/customer_transaction');
        $this->load->library('json');

        $page = $this->request->post['page']; // get the requested page
        $limit = $this->request->post['rows']; // get how many rows we want to have into the grid
        $sidx = $this->request->post['sidx']; // get index row - i.e. user click to sort
        $sord = $this->request->post['sord']; // get the direction

        $data = [
            'sort'        => $sidx,
            'order'       => $sord,
            'start'       => ($page - 1) * $limit,
            'limit'       => $limit,
            'customer_id' => (int) $this->request->get['customer_id'],
        ];

        if (has_value($this->request->get['user'])) {
            $data['filter']['user'] = $this->request->get['user'];
        }
        if (has_value($this->request->get['credit'])) {
            $data['filter']['credit'] = $this->request->get['credit'];
        }
        if (has_value($this->request->get['debit'])) {
            $data['filter']['debit'] = $this->request->get['debit'];
        }
        if (has_value($this->request->get['transaction_type'])) {
            $data['filter']['transaction_type'] = $this->request->get['transaction_type'];
        }
        if (has_value($this->request->get['date_start'])) {
            $data['filter']['date_start'] = dateDisplay2ISO($this->request->get['date_start']);
        }
        if (has_value($this->request->get['date_end'])) {
            $data['filter']['date_end'] = dateDisplay2ISO($this->request->get['date_end']);
        }

        $allowedFields = array_merge(
            ['user', 'credit', 'debit', 'transaction_type', 'date_start', 'date_end'],
            (array) $this->data['allowed_fields']
        );

        if (isset($this->request->post['_search']) && $this->request->post['_search'] == 'true') {
            $searchData = AJson::decode(htmlspecialchars_decode($this->request->post['filters']), true);

            foreach ($searchData['rules'] as $rule) {
                if (!in_array($rule['field'], $allowedFields)) {
                    continue;
                }
                $data['filter'][$rule['field']] = trim($rule['data']);
            }
        }

        $total = $this->model_sale_customer_transaction->getTotalCustomerTransactions($data);

        if ($total > 0) {
            $total_pages = ceil($total / $limit);
        } else {
            $total_pages = 0;
        }

        if ($page > $total_pages) {
            $page = $total_pages;
            $data['start'] = ($page - 1) * $limit;
        }

        $response = new stdClass();
        $response->page = $page;
        $response->total = $total_pages;
        $response->records = $total;

        $results = $this->model_sale_customer_transaction->getCustomerTransactions($data);
        $i = 0;
        foreach ($results as $result) {
            $response->rows[$i]['id'] = $result['customer_transaction_id'];
            $response->rows[$i]['cell'] = [
                $result['date_added'],
                $result['user'],
                $result['debit'],
                $result['credit'],
                $result['transaction_type'],
            ];
            $i++;
        }
        $this->data['response'] = $response;
        //update controller data
        $this->extensions->hk_UpdateData($this, __FUNCTION__);
        $this->load->library('json');
        $this->response->addJSONHeader();
        $this->response->setOutput(AJson::encode($this->data['response']));
    }

    private function validateForm($data = [])
    {
        $output = [
            'credit' => (float) $data['credit'],
            'debit'  => (float) $data['debit'],
        ];

        if (!$output['credit'] && !$output['debit']) {
            $this->error[] = $this->language->get('error_empty_debit_credit');
        } else {
            if ($output['credit'] > 99999999999.9999 || $output['debit'] > 99999999999.9999) {
                $this->error[] = $this->language->get('error_incorrect_debit_credit');
            }
        }

        if ($data['transaction_type'][1]) {
            $output['transaction_type'] = trim($data['transaction_type'][1]);
            $this->cache->remove('transaction_types');
        } else {
            $output['transaction_type'] = trim($data['transaction_type'][0]);
        }

        if (!$output['transaction_type']) {
            $this->error[] = $this->language->get('error_transaction_type');
        }
        $output['transaction_type'] = htmlentities($output['transaction_type'], ENT_QUOTES, 'UTF-8');
        $output['comment'] = htmlentities($data['comment'], ENT_QUOTES, 'UTF-8');
        $output['description'] = htmlentities($data['description'], ENT_QUOTES, 'UTF-8');
        $output['notify'] = (int) $data['notify'] ? 1 : 0;
        $this->data['output'] = $output;
        $this->extensions->hk_ValidateData($this);

        return $this->data['output'];
    }

    public function addTransaction()
    {
        if (!$this->csrftoken->isTokenValid()) {
            $error = new AError('');
            return $error->toJSONResponse(
                'NO_PERMISSIONS_402',
                ['error_text' => 'Unknown error']
            );
        }
        //init controller data
        $this->extensions->hk_InitData($this, __FUNCTION__);

        if (!$this->user->canModify('listing_grid/customer_transaction') || $this->request->is_GET()) {
            $error = new AError('');
            return $error->toJSONResponse(
                'NO_PERMISSIONS_402',
                [
                    'error_text'  => sprintf(
                        $this->language->get('error_permission_modify'),
                        'listing_grid/customer_transaction'
                    ),
                    'reset_value' => true,
                ]
            );
        }

        $this->loadLanguage('sale/customer');
        $this->loadModel('sale/customer_transaction');

        //check is data valid
        $post = $this->request->post;
        if ($post['credit']) {
            $post['credit'] = preformatFloat($post['credit']);
        }
        if ($post['debit']) {
            $post['debit'] = preformatFloat($post['debit']);
        }

        $valid_data = $this->validateForm($post);
        $valid_data['customer_id'] = $this->request->get['customer_id'];

        if (!$this->error) {
            $this->model_sale_customer_transaction->addCustomerTransaction($valid_data);
            $result['result'] = true;
            $result['result_text'] = $this->language->get('text_transaction_success');
            $balance = $this->model_sale_customer_transaction->getBalance($this->request->get['customer_id']);
            $result['balance'] = $this->language->get('text_balance').' '.$this->currency->format(
                    $balance,
                    $this->config->get('config_currency')
                );
        } else {
            $error = new AError('');
            return $error->toJSONResponse(
                'VALIDATION_ERROR_406',
                [
                    'error_text'   => $this->error,
                    'csrfinstance' => $this->csrftoken->setInstance(),
                    'csrftoken'    => $this->csrftoken->setToken(),
                    'reset_value'  => true,
                ]
            );
        }

        //update controller data
        $this->extensions->hk_UpdateData($this, __FUNCTION__);

        $this->load->library('json');
        $this->response->addJSONHeader();
        $this->response->setOutput(AJson::encode($result));
    }

    public function transaction()
    {
        //init controller data
        $this->extensions->hk_InitData($this, __FUNCTION__);
        $this->load->library('json');
        $this->loadLanguage('sale/customer');
        $this->loadModel('sale/customer_transaction');

        if (!$this->user->canAccess('listing_grid/customer_transaction')) {
            $error = new AError('');
            return $error->toJSONResponse(
                'NO_PERMISSIONS_402',
                [
                    'error_text'  => sprintf(
                        $this->language->get('error_permission_access'),
                        'listing_grid/customer_transaction'
                    ),
                    'reset_value' => true,
                ]
            );
        }

        $transaction_id = (int) $this->request->get['customer_transaction_id'];
        $this->data['customer_transaction_id'] = $transaction_id;

        if ($transaction_id) {
            $info = $this->model_sale_customer_transaction->getCustomerTransaction(
                $this->request->get['customer_transaction_id']
            );

            $this->data['text_title'] = $this->language->get('popup_title_info');
            $readonly = true;
        } else {
            $this->data['text_title'] = $this->language->get('popup_title_insert');
            $readonly = false;
            $info = [];
        }

        $form = new AForm();
        $form->setForm(
            [
                'form_name' => 'transaction_form',
            ]
        );
        $this->data['form']['form_open'] = $form->getFieldHtml(
            [
                'type'   => 'form',
                'name'   => 'tFrm',
                'action' => $this->html->getSecureURL(
                    'listing_grid/customer_transaction/addtransaction',
                    '&customer_id='.$this->request->get['customer_id']
                ),
                'attr'   => 'data-confirm-exit="true" class="form-horizontal"',
                'csrf'   => true,
            ]
        );

        $this->data['form']['submit'] = $form->getFieldHtml(
            [
                'type' => 'button',
                'name' => 'submit',
                'text' => $this->language->get('button_save'),
            ]
        );

        $this->data['form']['cancel'] = $form->getFieldHtml(
            [
                'type' => 'button',
                'name' => 'cancel',
                'text' => $this->language->get('button_cancel'),
            ]
        );

        $this->data['form']['fields']['credit'] = $form->getFieldHtml(
            [
                'type'  => 'input',
                'name'  => 'credit',
                'value' => $info['credit'],
                'attr'  => ($readonly ? 'disabled="disabled"' : '').' maxlength="16"',
            ]
        );

        $this->data['form']['fields']['debit'] = $form->getFieldHtml(
            [
                'type'  => 'input',
                'name'  => 'debit',
                'value' => $info['debit'],
                'attr'  => ($readonly ? 'disabled="disabled"' : '').' maxlength="16"',
            ]
        );

        $types = $this->model_sale_customer_transaction->getTransactionTypes();
        $types[''] = $this->language->get('text_option_other_type');
        reset($types);

        $this->data['form']['fields']['transaction_type'] = $form->getFieldHtml(
            [
                'type'    => 'selectbox',
                'name'    => 'transaction_type[0]',
                'options' => $types,
                'value'   => $info['transaction_type'] == '' ? current($types) : $info['transaction_type'],
                'attr'    => ($readonly ? 'disabled="disabled"' : ''),
            ]
        );

        $this->data['form']['fields']['other_type'] = $form->getFieldHtml(
            [
                'type'        => 'input',
                'name'        => 'transaction_type[1]',
                'placeholder' => $this->language->get('text_other_type_placeholder'),
                'value'       => (!in_array($info['transaction_type'], $types) ? $info['transaction_type'] : ''),
                'attr'        => ($readonly ? 'disabled="disabled"' : ''),
            ]
        );

        if (!$readonly) {
            $this->data['form']['fields']['notify'] = $form->getFieldHtml(
                [
                    'type'    => 'checkbox',
                    'name'    => 'notify',
                    'value'   => 1,
                    'checked' => false,
                ]
            );
        }

        $this->data['form']['fields']['transaction_comment'] = $form->getFieldHtml(
            [
                'type'  => 'textarea',
                'name'  => 'comment',
                'value' => $info['comment'],
                'attr'  => ($readonly ? 'disabled="disabled"' : ''),
            ]
        );

        $this->data['form']['fields']['transaction_description'] = $form->getFieldHtml(
            [
                'type'  => 'textarea',
                'name'  => 'description',
                'value' => $info['description'],
                'attr'  => ($readonly ? 'disabled="disabled"' : ''),
            ]
        );

        if ($readonly) {
            $this->data['form']['fields']['date_added'] = $form->getFieldHtml(
                [
                    'type'  => 'input',
                    'name'  => 'date_added',
                    'value' => dateISO2Display(
                        $info['date_added'],
                        $this->language->get('date_format_short')
                        .' '.$this->language->get('time_format')
                    ),
                    'attr'  => 'disabled="disabled"',
                ]
            );
            $this->data['form']['fields']['date_modified'] = $form->getFieldHtml(
                [
                    'type'  => 'input',
                    'name'  => 'date_modified',
                    'value' => dateISO2Display(
                        $info['date_modified'],
                        $this->language->get('date_format_short')
                        .' '.$this->language->get('time_format')
                    ),
                    'attr'  => 'disabled="disabled"',
                ]
            );
        }

        //update controller data
        $this->extensions->hk_UpdateData($this, __FUNCTION__);

        $this->view->assign('help_url', $this->gen_help_url('customer_transaction_edit'));
        $this->view->batchAssign($this->data);

        $this->processTemplate('responses/sale/customer_transaction_form.tpl');
    }
}