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
if (!defined('DIR_CORE') || !IS_ADMIN) {
    header('Location: static_pages/');
}

class ControllerResponsesToolBackup extends AController
{
    public $errors = [];

    public function buildTask()
    {
        //init controller data
        $this->extensions->hk_InitData($this, __FUNCTION__);
        $this->data['output'] = [];

        if ($this->request->is_POST() && $this->_validate()) {
            $this->loadModel('tool/backup');
            $task_details = $this->model_tool_backup->createBackupTask('manual_backup', $this->request->post);
            $task_api_key = $this->config->get('task_api_key');

            if (!$task_details) {
                $this->errors = array_merge($this->errors, $this->model_tool_backup->errors);
                $error = new AError('files backup error');
                $error->toJSONResponse(
                    'APP_ERROR_402',
                    [
                        'error_text'  => implode(' ', $this->errors),
                        'reset_value' => true,
                    ]
                );
                return;
            } elseif (!$task_api_key) {
                $error = new AError('files backup error');
                $error->toJSONResponse(
                    'APP_ERROR_402',
                    [
                        'error_text'  => 'Please set up Task API Key in the settings!',
                        'reset_value' => true,
                    ]
                );
                return;
            } else {
                $task_details['task_api_key'] = $task_api_key;
                $task_details['url'] = HTTPS_SERVER.'task.php';
                $this->data['output']['task_details'] = $task_details;
            }
        }

        //update controller data
        $this->extensions->hk_UpdateData($this, __FUNCTION__);

        $this->load->library('json');
        $this->response->addJSONHeader();
        $this->response->setOutput(AJson::encode($this->data['output']));
    }

    /**
     * post-trigger of task
     */
    public function complete()
    {
        //init controller data
        $this->extensions->hk_InitData($this, __FUNCTION__);

        $task_id = (int) $this->request->post['task_id'];
        $result_text = '';
        if ($task_id) {
            $backup_name = '';
            $tm = new ATaskManager();
            //get backup_name
            $steps = $tm->getTaskSteps($task_id);
            if ($steps) {
                $step_info = current($steps);
                $backup_name = $step_info['settings']['backup_name'];
                $backup_name = !$backup_name ? 'manual_backup' : $backup_name;
            }
            $tm->deleteTask($task_id);
            $install_upgrade_history = new ADataset('install_upgrade_history', 'admin');

            $display_name = '';
            if (is_file(DIR_BACKUP.$backup_name.'.tar.gz')) {
                $display_name = $backup_name.'.tar.gz';
                $result_text = $this->html->convertLinks($this->language->get('backup_complete_text_file'));
            } elseif (is_dir(DIR_BACKUP.$backup_name)) {
                $display_name = $backup_name.'/...';
                $result_text = sprintf($this->language->get('backup_complete_text_dir'), DIR_BACKUP.$backup_name);
            }

            $install_upgrade_history->addRows(
                [
                    'date_added'  => date("Y-m-d H:i:s", time()),
                    'name'        => 'Manual Backup',
                    'version'     => VERSION,
                    'backup_file' => $display_name,
                    'backup_date' => date("Y-m-d H:i:s", time()),
                    'type'        => 'backup',
                    'user'        => $this->user->getUsername(),
                ]
            );
        }
        //update controller data
        $this->extensions->hk_UpdateData($this, __FUNCTION__);

        $this->load->library('json');
        $this->response->addJSONHeader();
        $this->response->setOutput(
            AJson::encode(
                [
                    'result'      => true,
                    'result_text' => $result_text,
                ]
            )
        );
    }

    public function main()
    {
        //init controller data
        $this->extensions->hk_InitData($this, __FUNCTION__);

        if ($this->request->is_POST() && $this->_validate()) {
            $this->loadModel('tool/backup');

            $bkp = $this->model_tool_backup->backup(
                $this->request->post['backup'], $this->request->post['backup_files'],
                $this->request->post['backup_config']
            );
            if ($bkp) {
                $install_upgrade_history = new ADataset('install_upgrade_history', 'admin');
                $install_upgrade_history->addRows(
                    [
                        'date_added'  => date("Y-m-d H:i:s", time()),
                        'name'        => 'Manual Backup',
                        'version'     => VERSION,
                        'backup_file' => $this->model_tool_backup->backup_filename.'.tar.gz',
                        'backup_date' => date("Y-m-d H:i:s", time()),
                        'type'        => 'backup',
                        'user'        => $this->user->getUsername(),
                    ]
                );
            }
            if ($this->model_tool_backup->errors) {
                $this->session->data['error'] = $this->model_tool_backup->errors;
                redirect($this->html->getSecureURL('tool/backup'));
            } else {
                $this->loadLanguage('tool/backup');
                $this->session->data['success'] = $this->language->get('text_success_backup');
                redirect($this->html->getSecureURL('tool/install_upgrade_history'));
            }
            //update controller data
            $this->extensions->hk_UpdateData($this, __FUNCTION__);
        } else {
            $this->dispatch('error/permission');
        }
    }

    protected function _validate()
    {
        if (!$this->user->canModify('tool/backup')) {
            $this->errors['warning'] = $this->language->get('error_permission');
        }

        $this->request->post['backup_code'] = $this->request->post['backup_code'] ? true : false;
        $this->request->post['backup_content'] = $this->request->post['backup_content'] ? true : false;
        $this->request->post['compress_backup'] = $this->request->post['compress_backup'] ? true : false;

        if (!$this->request->post['table_list']
            && !$this->request->post['backup_code']
            && !$this->request->post['backup_content']
        ) {
            $this->errors['warning'] = $this->language->get('error_nothing_to_backup');
        }

        $this->extensions->hk_ValidateData($this);

        return (!$this->errors);
    }
}