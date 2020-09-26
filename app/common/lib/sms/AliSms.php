<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/24
 * Time: 12:21
 */
declare(strict_types=1);

namespace app\common\lib\sms;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use think\facade\Log;

class  AliSms implements SmsBase
{

    /**
     * Notess:阿里云短信
     * User: Lint
     * Date: 2020/9/24 16:35
     * @param string $phone
     * @param string $code
     * @return bool
     * @throws ClientException
     */
    public static function sendCode(string $phone, int $code)
    {
        if (empty($phone) || empty($code)) {
            return false;
        }
        return true;
        AlibabaCloud::accessKeyClient(config('aliyun.access_key_id'), config('aliyun.access_key_secret'))
            ->regionId(config('aliyun.region_id'))
            ->asDefaultClient();

        $templateParam = [
            'code' => $code,
        ];
        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host(config('aliyun.host'))
                ->options([
                    'query' => [
                        'RegionId' => config('aliyun.region_id'),
                        'PhoneNumbers' => $phone,
                        'SignName' => config('aliyun.sign_name'),
                        'TemplateCode' => config('aliyun.template_code'),
                        'TemplateParam' => json_encode($templateParam),
                    ],
                ])
                ->request();
            Log::info("alisms-sendCode-{$phone}-result：" . json_encode($result->toArray()));
            // print_r($result->toArray());
            // echo 1111;
            // die;
        } catch (ClientException $e) {
            Log::error("alisms-sendCode-{$phone}-ClientException：" . $e->getErrorMessage());
            return false;
            // echo $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            Log::error("alisms-sendCode-{$phone}-ServerException： " . $e->getErrorMessage());
            return false;
            // echo $e->getErrorMessage() . PHP_EOL;
        }
        if (isset($result['Code']) && $result['Code'] == 'OK') {
            return true;
        }
        return false;
    }
}
