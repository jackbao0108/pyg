<?php
//配置文件
return [
    'template' => [
        'layout_on' => true,//开启布局
        'layout_name' => 'layout/layout',//布局文件名称
        // 模板引擎类型 支持 php think 支持扩展
        'type' => 'Think',
        // 默认模板渲染规则 1 解析为小写+下划线 2 全部转换小写
        'auto_rule' => 1,
        // 模板路径
        'view_path' => '',
        // 模板后缀
        'view_suffix' => 'html',
        // 模板文件名分隔符
        'view_depr' => DS,
        // 模板引擎普通标签开始标记
        'tpl_begin' => '{',
        // 模板引擎普通标签结束标记
        'tpl_end' => '}',
        // 标签库标签开始标记
        'taglib_begin' => '{',
        // 标签库标签结束标记
        'taglib_end' => '}',
    ],
    //验证码
    'captcha' => [
        'length' => 4,
        'useCurve' => false,
        'useNoise' => false,
//        // 验证码图片高度
//        'imageH' => 10,
//        // 验证码图片宽度
//        'imageW' => 100,
    ],
];