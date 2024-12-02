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

class ControllerTaskSaleContact extends AController
{
    public $data = [];
    private $protocol;
    private $sent_count = 0;

    public function sendSms(...$args)
    {
        list($task_id, $step_id,) = $args;
        $this->load->library('json');
        //for aborting process
        ignore_user_abort(false);
        session_write_close();

        //init controller data
        $this->extensions->hk_InitData($this, __FUNCTION__);

        $this->protocol = 'sms';
        $this->sent_count = 0;
        $result = $this->_send($task_id, $step_id);
        if (!$this->sent_count) {
            $result = false;
        }
        //update controller data
        $this->extensions->hk_UpdateData($this, __FUNCTION__);

        $output = ['result' => $result];
        if ($result) {
            $output['message'] = $this->sent_count.' sms sent.';
        } else {
            $output['error_text'] = $this->sent_count.' sms sent.';
        }

        $this->response->setOutput(AJson::encode($output));
    }

    public function sendEmail(...$args)
    {
        list($task_id, $step_id,) = $args;

        $this->load->library('json');
        //for aborting process
        ignore_user_abort(false);
        session_write_close();

        //init controller data
        $this->extensions->hk_InitData($this, __FUNCTION__);

        $this->protocol = 'email';
        $this->sent_count = 0;
        $result = $this->_send($task_id, $step_id);
        if (!$this->sent_count) {
            $result = false;
        }

        //update controller data
        $this->extensions->hk_UpdateData($this, __FUNCTION__);
        $output = ['result' => $result];
        if ($result) {
            $output['message'] = $this->sent_count.' emails sent.';
        } else {
            $output['error_text'] = $this->sent_count.' emails sent.';
        }
        $this->response->setOutput(AJson::encode($output));
        return $result;
    }

    private function _send($task_id, $step_id)
    {

        $this->loadLanguage('sale/contact');

        if (!$task_id || !$step_id) {
            $error_text = 'Cannot run task step. Task_id (or step_id) has not been set.';
            $this->_return_error($error_text);
        }

        $tm = new ATaskManager();
        $task_info = $tm->getTaskById($task_id);
        $sent = (int)$task_info['settings']['sent'];
        $task_steps = $tm->getTaskSteps($task_id);
        $step_info = [];
        foreach ($task_steps as $task_step) {
            if ($task_step['step_id'] == $step_id) {
                $step_info = $task_step;
                if ($task_step['sort_order'] == 1) {
                    $tm->updateTask($task_id, ['last_time_run' => date('Y-m-d H:i:s')]);
                }
                break;
            }
        }

        if (!$step_info) {
            $error_text = 'Cannot run task step. Looks like task #'.$task_id.' does not contain step #'.$step_id;
            $this->_return_error($error_text);
        }

        $tm->updateStep($step_id, ['last_time_run' => date('Y-m-d H:i:s')]);

        if (!$step_info['settings']) {
            $error_text = 'Cannot run task step #'.$step_id.'. Unknown settings for it.';
            $this->_return_error($error_text);
        }

        $this->loadModel('sale/customer');
        $this->loadModel('setting/store');
        $store_info = $this->model_setting_store->getStore((int)$this->session->data['current_store_id']);
        $from = '';
        if ($store_info) {
            $from = $store_info['store_main_email'];
        }
        if (!$from) {
            $from = $this->config->get('store_main_email');
        }

        $send_data = [
            'subject' => $step_info['settings']['subject'],
            'message' => $step_info['settings']['message'],
            'sender'  => $step_info['settings']['store_name'],
            'from'    => $from,
        ];
        //send emails in loop and update task's step info for restarting if step or task failed
        $step_settings = $step_info['settings'];
        $cnt = 0;
        $step_result = true;
        $send_to = $step_info['settings']['to'];
        //remove step if no recipients
        if (!$send_to) {
            $tm->deleteStep($step_id);
            if (sizeof($task_steps) == 1) {
                $tm->deleteTask($task_id);
            }
            return true;
        }
        foreach ($send_to as $to) {
            $send_data['subscriber'] = in_array($to, $step_info['settings']['subscribers']);

            if ($this->protocol == 'email') {
                $result = $this->_send_email($to, $send_data);
            } elseif ($this->protocol == 'sms') {
                $result = $this->_send_sms($to, $send_data);
            } else {
                $result = false;
            }

            if ($result) {
                $this->sent_count++;
                //remove sent address from step
                $k = array_search($to, $step_settings['to']);
                unset($step_settings['to'][$k]);
                $tm->updateStep($step_id, ['settings' => serialize($step_settings)]);
                //update task details to show them at the end
                $sent++;
                $tm->updateTaskDetails($task_id,
                                       [
                                           //set 1 as "admin"
                                           'created_by' => 1,
                                           'settings'   => [
                            'recipients_count' => $task_info['settings']['recipients_count'],
                            'sent'             => $sent,
                                           ],
                                       ]
                );

            } else {
                $step_result = false;
            }
            $cnt++;
        }

        $tm->updateStep($step_id, ['last_result' => $step_result]);

        if (!$step_result) {
            $this->_return_error('Some errors during step run.');
        }
        return $step_result;
    }

    private function _return_error($error_text)
    {
        $error = new AError($error_text);
        $error->toLog()->toDebug();
        return $error->toJSONResponse('APP_ERROR_402',
                                      [
                'error_text'  => $error_text,
                'reset_value' => true,
                                      ]
        );
    }

    private function _send_email($email, $data)
    {
        if (!$email || !$data) {
            $error = new AError('Error: Cannot send email. Unknown address or empty message.');
            $error->toLog();
            return false;
        }

        // HTML Mail
        $this->data['mail_template_data']['lang_direction'] = $this->language->get('direction');
        $this->data['mail_template_data']['lang_code'] = $this->language->get('code');
        $this->data['mail_template_data']['subject'] = $data['subject'];

        $text_unsubscribe = $this->language->get('text_unsubscribe');
        $message_body = $data['message'];
        if ($data['subscriber']) {
            $customer_info = $this->model_sale_customer->getCustomersByEmails([$email]);
            $customer_id = $customer_info[0]['customer_id'];
            if ($customer_id) {
                $message_body .= "\n\n<br><br>".sprintf($text_unsubscribe,
                        $email,
                        $this->html->getCatalogURL('account/notification',
                            '&email='.$email.'&customer_id='.$customer_id));
            }
        }

        $this->data['mail_template_data']['body'] = html_entity_decode($message_body, ENT_QUOTES, 'UTF-8');
        $this->data['mail_template'] = 'mail/contact.tpl';

        //allow to change email data from extensions
        $this->extensions->hk_ProcessData($this, 'cp_sale_contact_mail');

        $view = new AView($this->registry, 0);
        $view->batchAssign($this->data['mail_template_data']);
        $html_body = $view->fetch($this->data['mail_template']);

        $mail = new AMail($this->config);
        $mail->setTo($email);
        $mail->setFrom($data['from']);
        $mail->setSender($data['sender']);
        $mail->setSubject($this->data['mail_template_data']['subject']);
        $mail->setHtml($html_body);
        $mail->send();

        if ($mail->error) {
            $error = new AError('AMail Errors: '.implode("\n", $mail->error));
            $error->toLog()->toDebug();
            return false;
        }

        return true;
    }

    private function _send_sms($phone, $data)
    {
        if (!$phone || !$data) {
            $error = new AError('Error: Cannot send sms. Unknown phone number or empty message.');
            $error->toLog();
            return false;
        }

        $driver = null;
        $driver_txt_id = $this->config->get('config_sms_driver');

        //if driver not set - skip protocol
        if (!$driver_txt_id) {
            return false;
        }
        //use safe usage
        try {
            include_once(DIR_EXT.$driver_txt_id.'/core/lib/'.$driver_txt_id.'.php');
            //if class of driver
            $classname = preg_replace('/[^a-zA-Z]/', '', $driver_txt_id);
            if (!class_exists($classname)) {
                $error = new AError('IM-driver '.$driver_txt_id.' load error.');
                $error->toLog()->toMessages();
                return false;
            }

            $driver = new $classname();
        } catch (AException $e) {
        }

        if ($driver === null) {
            return false;
        }

        $text = $this->config->get('store_name').": ".$data['message'];
        $to = $phone;
        $result = true;
        if ($text && $to) {
            //use safe call
            try {
                $result = $driver->send($to, $text);
            } catch (AException $e) {
                return false;
            }
        }

        return $result;
    }

}
