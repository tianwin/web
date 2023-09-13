<?php

namespace Mautic\NotificationBundle\Api;

use Mautic\NotificationBundle\Entity\Notification;
use Mautic\NotificationBundle\Exception\MissingApiKeyException;
use Mautic\NotificationBundle\Exception\MissingAppIDException;
use Psr\Http\Message\ResponseInterface;

class OneSignalApi extends AbstractNotificationApi
{
    /**
     * @var string
     */
    protected $apiUrlBase = 'https://onesignal.com/api/v1';

    /**
     * @throws MissingAppIDException
     * @throws MissingApiKeyException
     */
    public function send(string $endpoint, array $data): ResponseInterface
    {
        $apiKeys    = $this->integrationHelper->getIntegrationObject('OneSignal')->getKeys();
        $appId      = $apiKeys['app_id'];
        $restApiKey = $apiKeys['rest_api_key'];

        if (!$restApiKey) {
            throw new MissingApiKeyException();
        }

        if (!array_key_exists('app_id', $data)) {
            if (!$appId) {
                throw new MissingAppIDException();
            }

            $data['app_id'] = $appId;
        }

        return $this->http->post(
            $this->apiUrlBase.$endpoint,
            [
                \GuzzleHttp\RequestOptions::HEADERS => [
                    'Authorization' => 'Basic '.$restApiKey,
                    'Content-Type'  => 'application/json',
                ],
                \GuzzleHttp\RequestOptions::JSON => $data,
            ]
        );
    }

    /**
     * @param string|array $playerId Player ID as string, or an array of player ID's
     *
     * @throws \Exception
     */
    public function sendNotification($playerId, Notification $notification): ResponseInterface
    {
        $data = [];

        $buttonId = $notification->getHeading();
        $title    = $notification->getHeading();
        $url      = $notification->getUrl();
        $button   = $notification->getButton();
        $message  = $notification->getMessage();

        if (!is_array($playerId)) {
            $playerId = [$playerId];
        }

        $data['include_player_ids'] = $playerId;

        if (!is_array($message)) {
            $message = ['en' => $message];
        }

        $data['contents'] = $message;

        if (!empty($title)) {
            if (!is_array($title)) {
                $title = ['en' => $title];
            }
        }

        $data['headings'] = $title;

        if ($url) {
            $data['url'] = $url;
        }

        if ($notification->isMobile()) {
            $this->addMobileData($data, $notification->getMobileSettings());

            if ($button) {
                $data['buttons'][] = ['id' => $buttonId, 'text' => $button];
            }
        } else {
            if ($button && $url) {
                $data['web_buttons'][] = ['id' => $buttonId, 'text' => $button, 'url' => $url];
            }
        }

        return $this->send('/notifications', $data);
    }

    protected function addMobileData(array &$data, array $mobileConfig)
    {
        foreach ($mobileConfig as $key => $value) {
            switch ($key) {
                case 'ios_subtitle':
                    $data['subtitle'] = ['en' => $value];
                    break;
                case 'ios_sound':
                    $data['ios_sound'] = $value ?: 'default';
                    break;
                case 'ios_badges':
                    $data['ios_badgeType'] = $value;
                    break;
                case 'ios_badgeCount':
                    $data['ios_badgeCount'] = (int) $value;
                    break;
                case 'ios_contentAvailable':
                    $data['content_available'] = (bool) $value;
                    break;
                case 'ios_media':
                    $data['ios_attachments'] = [uniqid('id_') => $value];
                    break;
                case 'ios_mutableContent':
                    $data['mutable_content'] = (bool) $value;
                    break;
                case 'android_sound':
                    $data['android_sound'] = $value;
                    break;
                case 'android_small_icon':
                    $data['small_icon'] = $value;
                    break;
                case 'android_large_icon':
                    $data['large_icon'] = $value;
                    break;
                case 'android_big_picture':
                    $data['big_picture'] = $value;
                    break;
                case 'android_led_color':
                    $data['android_led_color'] = 'FF'.strtoupper($value);
                    break;
                case 'android_accent_color':
                    $data['android_accent_color'] = 'FF'.strtoupper($value);
                    break;
                case 'android_group_key':
                    $data['android_group'] = $value;
                    break;
                case 'android_lockscreen_visibility':
                    $data['android_visibility'] = (int) $value;
                    break;
                case 'additional_data':
                    // Transforms values received from SortableListType into values acceptable by OneSignal.
                    if (count($value['list']) > 0) {
                        $result = [];
                        foreach ($value['list'] as $item) {
                            $result[$item['label']] = $item['value'];
                        }
                        $data['data'] = $result;
                    }
                    break;
            }
        }
    }
}
