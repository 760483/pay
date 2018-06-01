<?php

// +----------------------------------------------------------------------
// | ThinkApiAdmin
// +----------------------------------------------------------------------

/**
 * Api接口路由
 */

// 命令行生成路由缓存 optimize:route
// php think optimize:route

// 方法前置
$afterBehavior = ['\app\api\behavior\ApiAuth', '\app\api\behavior\RequestFilter',];

// 路由控制器路径必须以api打头!!!
return [
    '[api]' => [
        // pay 5a570d64428ca
        '5a570d64428ca' => [
            'api/Index/index',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        // 获取AccessToken 5a60c77b79875
        '5a60c77b79875' => [
            'api/Buildtoken/getAccessToken',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        // 图片上传接口(单文件,支持云存储)base64加密传输 5a64a01c9ed67
        '5a64a01c9ed67' => [
            'api/Tool/uploadImage',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        // 文件上传接口(单文件,云存储)模拟HTTP的Post请求方式 5a63444c41b45
        '5a63444c41b45' => [
            'api/Tool/uploadFile',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        // 文件上传接口(支持多文件文件,本地存储)模拟HTTP的Post请求方式 5acce4ff98111
        '5acce4ff98111' => [
            'api/Tool/uploadFiles',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        // 根据手机号获取验证码 (短信签名) 5acd9f48bb275
        '5acd9f48bb275' => [
            'api/Tool/getVcodeByMobile',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        // 根据Email获取验证码 5acdaf03ae160
        '5acdaf03ae160' => [
            'api/Tool/getVcodeByEmail',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        // 获取省份名称和ID 5a6ad33cd8b30
        '5a6ad33cd8b30' => [
            'api/Tool/getProvinceList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        // 获取城市名称和ID通过省份ID 5a6ad3bc9c27e
        '5a6ad3bc9c27e' => [
            'api/Tool/getCityListByPid',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        // 获取县区名称和ID通过城市ID 5a6ad401210c7
        '5a6ad401210c7' => [
            'api/Tool/getDistrictListByCid',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        // 测试 5b07b9e633017
        '5b07b9e633017' => [
            'api/Alipay/notify',
            ['method' => 'get|post', 'after_behavior' => $afterBehavior]
        ],
        // 获取商品列表 5b0bcbfea5da3
        '5b0bcbfea5da3' => [
            'api/Goods/lists',
            ['method' => 'get|post', 'after_behavior' => $afterBehavior]
        ],
        // 规格列表 5b0bcc45e23eb
        '5b0bcc45e23eb' => [
            'api/Sku/list',
            ['method' => 'get|post', 'after_behavior' => $afterBehavior]
        ],
        // banner  5b0caf662c3a9
        '5b0caf662c3a9' => [
            'api/Goods/banner',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        // 商品分类 5b0cf6c3723a2
        '5b0cf6c3723a2' => [
            'api/Goods/classlist',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        // 手机号码归属地查询 5b0f8fda9e202
        '5b0f8fda9e202' => [
            'api/index/phone',
            ['method' => 'get|post', 'after_behavior' => $afterBehavior]
        ],

        // 接口Hash异常跳转
        '__miss__' => ['api/Miss/index'],
    ],
];