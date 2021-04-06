<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2019/5/27
 * Time: 11:42
 */
namespace cncn\insurance\ypic\service;

class ProductType
{
    public static $proList = [
        //出、入境（含港澳台）旅游人身意外险保险
        //方案一（年龄70岁之前）
        '11430010001' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 10,
            'price'  => 80.00,
            'amount' => 800000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 1
        ],
        '11430010002' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 16,
            'price'  => 90.00,
            'amount' => 800000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 1
        ],
        '11430010003' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 17,
            'maxDay' => 25,
            'price'  => 95.00,
            'amount' => 800000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 1
        ],
        '11430010004' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 26,
            'maxDay' => 1000,
            'price'  => 100.00,
            'amount' => 800000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 1
        ],

        //方案二（年龄70岁之前）
        '11430010005' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 10,
            'price'  => 40.00,
            'amount' => 500000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 1
        ],
        '11430010006' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 16,
            'price'  => 50.00,
            'amount' => 500000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 1
        ],
        '11430010007' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 17,
            'maxDay' => 25,
            'price'  => 55.00,
            'amount' => 500000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 1
        ],
        '11430010008' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 26,
            'maxDay' => 1000,
            'price'  => 60.00,
            'amount' => 500000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 1
        ],

        //方案三（年龄70岁之前）
        '11430010009' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 10,
            'price'  => 15.00,
            'amount' => 300000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 1
        ],
        '11430010010' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 16,
            'price'  => 20.00,
            'amount' => 300000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 1
        ],
        '11430010011' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 17,
            'maxDay' => 25,
            'price'  => 25.00,
            'amount' => 300000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 1
        ],
        '11430010012' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 26,
            'maxDay' => 1000,
            'price'  => 30.00,
            'amount' => 300000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 1
        ],

        //方案一（年龄70岁至80岁）
        '11430010013' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 10,
            'price'  => 80.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 1
        ],
        '11430010014' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 16,
            'price'  => 90.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 1
        ],
        '11430010015' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 17,
            'maxDay' => 25,
            'price'  => 95.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 1
        ],
        '11430010016' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 26,
            'maxDay' => 1000,
            'price'  => 100.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 1
        ],

        //方案二（年龄70岁至80岁）
        '11430010017' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 10,
            'price'  => 40.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 1
        ],
        '11430010018' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 16,
            'price'  => 50.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 1
        ],
        '11430010019' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 17,
            'maxDay' => 25,
            'price'  => 55.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 1
        ],
        '11430010020' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 26,
            'maxDay' => 1000,
            'price'  => 60.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 1
        ],

        //方案三（年龄70岁至80岁）
        '11430010021' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 10,
            'price'  => 15.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 1
        ],
        '11430010022' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 16,
            'price'  => 20.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 1
        ],
        '11430010023' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 17,
            'maxDay' => 25,
            'price'  => 25.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 1
        ],
        '11430010024' => [
            'name'   => '出、入境（含港澳台）旅游人身意外险保险',
            'minDay' => 26,
            'maxDay' => 1000,
            'price'  => 30.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 1
        ],

        //（国内游）旅游人身意外险保险
        //方案一（年龄70岁之前）
        '11430010025' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 20,
            'price'  => 20.00,
            'amount' => 300000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010026' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 8,
            'maxDay' => 10,
            'price'  => 15.00,
            'amount' => 300000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010027' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 4,
            'maxDay' => 7,
            'price'  => 12.00,
            'amount' => 300000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010028' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 2,
            'maxDay' => 3,
            'price'  => 5.00,
            'amount' => 300000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010029' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 1,
            'price'  => 1.00,
            'amount' => 300000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],

        //方案二（年龄70岁之前）
        '11430010030' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 20,
            'price'  => 30.00,
            'amount' => 500000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010031' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 8,
            'maxDay' => 10,
            'price'  => 25.00,
            'amount' => 500000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010032' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 4,
            'maxDay' => 7,
            'price'  => 20.00,
            'amount' => 500000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010033' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 2,
            'maxDay' => 3,
            'price'  => 10.00,
            'amount' => 500000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010034' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 1,
            'price'  => 3.00,
            'amount' => 500000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],

        //方案三（年龄70岁之前）
        '11430010035' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 20,
            'price'  => 50.00,
            'amount' => 800000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010036' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 8,
            'maxDay' => 10,
            'price'  => 40.00,
            'amount' => 800000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010037' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 4,
            'maxDay' => 7,
            'price'  => 35.00,
            'amount' => 800000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010038' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 2,
            'maxDay' => 3,
            'price'  => 15.00,
            'amount' => 800000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010039' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 1,
            'price'  => 5.00,
            'amount' => 800000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],

        //方案一（（年龄70岁至80岁）
        '11430010040' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 20,
            'price'  => 20.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010041' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 8,
            'maxDay' => 10,
            'price'  => 15.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010042' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 4,
            'maxDay' => 7,
            'price'  => 12.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010043' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 2,
            'maxDay' => 3,
            'price'  => 5.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010044' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 1,
            'price'  => 1.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],

        //方案二（（年龄70岁至80岁）
        '11430010045' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 20,
            'price'  => 30.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010046' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 8,
            'maxDay' => 10,
            'price'  => 25.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010047' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 4,
            'maxDay' => 7,
            'price'  => 20.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010048' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 2,
            'maxDay' => 3,
            'price'  => 10.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010049' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 1,
            'price'  => 3.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],

        //方案三（（年龄70岁至80岁）
        '11430010050' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 20,
            'price'  => 50.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010051' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 8,
            'maxDay' => 10,
            'price'  => 40.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010052' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 4,
            'maxDay' => 7,
            'price'  => 35.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010053' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 2,
            'maxDay' => 3,
            'price'  => 15.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010054' => [
            'name'   => '（国内游）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 1,
            'price'  => 5.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],

        //（自驾游）旅游人身意外险保险
        //方案一（年龄70岁之前）
        '11430010055' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 21,
            'maxDay' => 30,
            'price'  => 50.00,
            'amount' => 300000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010056' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 20,
            'price'  => 45.00,
            'amount' => 300000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010057' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 8,
            'maxDay' => 10,
            'price'  => 25.00,
            'amount' => 300000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010058' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 7,
            'price'  => 20.00,
            'amount' => 300000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],

        //方案二（年龄70岁之前）
        '11430010059' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 21,
            'maxDay' => 30,
            'price'  => 60.00,
            'amount' => 500000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010060' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 20,
            'price'  => 50.00,
            'amount' => 500000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010061' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 8,
            'maxDay' => 10,
            'price'  => 30.00,
            'amount' => 500000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010062' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 7,
            'price'  => 25.00,
            'amount' => 500000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],

        //方案三（年龄70岁之前）
        '11430010063' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 21,
            'maxDay' => 30,
            'price'  => 90.00,
            'amount' => 800000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010064' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 20,
            'price'  => 80.00,
            'amount' => 800000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010065' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 8,
            'maxDay' => 10,
            'price'  => 50.00,
            'amount' => 800000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],
        '11430010066' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 7,
            'price'  => 35.00,
            'amount' => 800000.00,
            'minAge' => 0,
            'maxAge' => 69,
            'domesticInd' => 0
        ],

        //方案一（年龄70岁至80岁）
        '11430010067' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 21,
            'maxDay' => 30,
            'price'  => 50.00,
            'amount' => 800000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010068' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 20,
            'price'  => 45.00,
            'amount' => 800000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010069' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 8,
            'maxDay' => 10,
            'price'  => 25.00,
            'amount' => 800000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010070' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 7,
            'price'  => 20.00,
            'amount' => 800000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],

        //方案二（年龄70岁至80岁）
        '11430010071' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 21,
            'maxDay' => 30,
            'price'  => 60.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010072' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 20,
            'price'  => 50.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010073' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 8,
            'maxDay' => 10,
            'price'  => 30.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010074' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 7,
            'price'  => 25.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],

        //方案三（年龄70岁至80岁）
        '11430010075' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 21,
            'maxDay' => 30,
            'price'  => 90.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010076' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 11,
            'maxDay' => 20,
            'price'  => 80.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010077' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 8,
            'maxDay' => 10,
            'price'  => 50.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
        '11430010078' => [
            'name'   => '（自驾游）旅游人身意外险保险',
            'minDay' => 1,
            'maxDay' => 7,
            'price'  => 35.00,
            'amount' => 100000.00,
            'minAge' => 70,
            'maxAge' => 80,
            'domesticInd' => 0
        ],
    ];

    /**
     * 获取所有国内游保险产品
     * @return array
     */
    public static function getInlandProductList()
    {
        return array_filter(self::$proList, function($val){
            return $val['domesticInd'] == 0;
        });
    }

    /**
     * 获取所有出境游保险产品
     * @return array
     */
    public static function getForeignProductList()
    {
        return array_filter(self::$proList, function($val){
            return $val['domesticInd'] == 1;
        });
    }

    /**
     * 获取所有国内游保险产品代码
     * @return array
     */
    public static function getInlandProductCodeList()
    {
        $filterResult = self::getInlandProductList();
        return array_keys($filterResult);
    }

    /**
     * 获取所有出境游产品代码
     * @return array
     */
    public static function getForeignProductCodeList()
    {
        $filterResult = self::getForeignProductList();
        return array_keys($filterResult);
    }

    /**
     * 根据是否出境游，天数，年龄来匹配产品列表，最后返回可匹配产品
     * @param $domesticInd
     * @param $days
     * @param $age
     * @return array
     */
    public static function getProductByAgeAndDaysAndDomesticIndType($domesticInd, $days, $age)
    {
        if(!in_array($domesticInd, [0, 1])){
            throw new \RuntimeException('是否出境游参数错误');
        }

        $filterResult = array_filter(self::$proList, function($val)use($domesticInd){
            return $val['domesticInd'] == $domesticInd;
        });

        if(empty($filterResult)){
            if($domesticInd == 0) {
                throw new \RuntimeException('没有筛选到对应的国内游保险');
            }else{
                throw new \RuntimeException('没有筛选到对应的出境游保险');
            }
        }

        $filterResult = array_filter($filterResult, function($val)use($age){
            return $val['minAge'] >= $age && $val['maxAge'] <= $age;
        });

        if(empty($filterResult)){
            throw new \RuntimeException('没有筛选到匹配年龄' . $age . '岁的产品');
        }

        $filterResult = array_filter($filterResult, function($val)use($days){
            return ($val['minDay'] >= $days && $val['maxDay'] <= $days) || $val['maxDay'] <= $days;
        });

        if(empty($filterResult)){
            throw new \RuntimeException('没有筛选到匹配天数' . $days . '岁的产品');
        }

        return $filterResult;
    }


    /**
     * 返回可匹配保险产品代码map
     * @param $domesticInd
     * @param $days
     * @param $age
     * @return array
     */
    public static function getProductCodeListByAgeAndDaysAndDomesticIndType($domesticInd, $days, $age)
    {
        try {
            $filterResult = self::getProductByAgeAndDaysAndDomesticIndType($domesticInd, $days, $age);
            return array_keys($filterResult);
        }catch (\Exception $e){
            return [];
        }
    }

    public static $domesticInd = [
        0 => '国内游',
        1 => '境外游'
    ];
}