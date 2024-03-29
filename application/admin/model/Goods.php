<?php

namespace app\admin\model;

use think\Model;

class Goods extends Model
{
    //定义完整的数据表名称
//    protected $table = 'tpshop_goods';

    //设置软删除
    use \traits\model\SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $hidden = ['create_time', 'update_time', 'delete_time'];

    public function category()
    {
        return $this->belongsTo('Category', 'cate_id');
    }

    public function type()
    {
        return $this->belongsTo('Type');
    }

    public function brand()
    {
        return $this->belongsTo('brand');
    }

    public function goodsImages()
    {
        return $this->hasMany('GoodsImages');
    }

    public function specGoods()
    {
        return $this->hasMany('SpecGoods');
    }

    public function getGoodsAttrAttr($value)
    {
        return json_decode($value, true);
    }

    public static function getGoodsWithSpecGoods($spec_goods_id, $goods_id = 0)
    {
        if ($spec_goods_id) {
            //没有指定sku 则 根据商品id取第一个
            $where = ['t2.id' => $spec_goods_id];
        } else {
            $where = ['t1.id' => $goods_id];
        }
        $goods = self::alias('t1')
            ->field('t1.*, t2.id as spec_goods_id, t2.value_ids, t2.value_names, t2.price, t2.cost_price as cost_price2, t2.store_count')
            ->join(config('database.prefix') . 'spec_goods t2', 't1.id=t2.goods_id', 'left')
            ->where($where)
            ->find();
        if ($goods->price > 0) {
            $goods->goods_price = $goods->price;
        }
        if ($goods->cost_price2 > 0) {
            $goods->cost_price = $goods->cost_price2;
        }
        return $goods;
    }

//    protected static function init()
//    {
//        try{
//            //实例化ES工具类
//            $es = new \tools\es\MyElasticsearch();
//            //设置新增回调
//            self::afterInsert(function($goods)use($es){
//                //添加文档
//                $doc = $goods->visible(['id', 'goods_name', 'goods_desc', 'goods_price', 'goods_logo'])->toArray();
//                $doc['cate_name'] = $goods->category->cate_name;
//                $es->add_doc($goods->id, $doc, 'goods_index', 'goods_type');
//            });
//            //设置更新回调
//            self::afterUpdate(function($goods)use($es){
//                //修改文档
//                $doc = $goods->visible(['id', 'goods_name', 'goods_desc', 'goods_price', 'goods_logo'])->toArray();
//                $doc['cate_name'] = $goods->category->cate_name;
//                $body = ['doc' => $doc];
//                $es->update_doc($goods->id, 'goods_index', 'goods_type', $body);
//            });
//            //设置删除回调
//            self::afterDelete(function($goods)use($es){
//                //删除文档
//                $es->delete_doc($goods->id, 'goods_index', 'goods_type');
//            });
//        }catch (\Exception $e){
//            $msg = $e->getMessage();
//            //记录日志
//            trace('ES同步商品数据失败：' . $msg, 'error');
//        }
//
//    }
}
