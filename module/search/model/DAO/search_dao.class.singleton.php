<?php
//////
class search_dao
{

    static $_instance;
    //////
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        } // end_if
        return self::$_instance;
    } // end_getInstance

    public function categories()
    {
        return db::query() -> select(['*'], 'img') -> where(['tipo' => ['cat']]) -> execute() -> queryToArray(true) -> toJSON();
    } // end_selectSlide

    public function homeLoadSliderProd()
    {
        // return db::query() -> select(['*'], 'cars') -> order([RAND()]) -> limit(10) -> execute() -> queryToArray(true) -> toJSON();
        return db::query() -> select(['*'], 'cars') 
        -> join([['img' => 'id', 'cars' => 'registration']], 'LEFT')
        -> order(['RAND()'])
        -> limit('10') 
        -> execute() 
        -> queryToArray() 
        -> toJSON();
    } // end_selectCategories

     public function load_brands($condition)
    {
        $typedQuery = "SELECT brand,count(brand) AS num FROM cars WHERE carcondition LIKE '{$condition}' GROUP BY brand ORDER BY count(brand) DESC";

        return db::query() -> manual($typedQuery)
        -> execute() 
        -> queryToArray() 
        -> toJSON();

        //La query de baix seria la manera correcta si el count es ficara be en el ORM
        // return db::query() -> select(['brand','count(brand)'], 'cars') 
        // -> where(['carcondition' => [$condition]])
        // -> group('brand')
        // -> order(['count(brand)'])
        // -> execute() 
        // -> queryToArray() 
        // -> toJSON();

    }
    public function load_autocomplete($keyword,$condition,$brand)
    {
        //  where(['brand' => [$brand . '%']], 'AND', 'LIKE')
        return db::query() -> select(['model'], 'cars') 
        // -> where(['model' => [$keyword]], '', 'LIKE')
        -> where(['carcondition' => [$condition], 'model' => ['%'.$keyword.'%'], 'brand' => [$brand]], 'AND', 'LIKE')
        -> execute() 
        -> queryToArray() 
        -> toJSON();
// $sql = "SELECT model FROM cars 
//                 WHERE model LIKE '%{$keyword}%' AND carcondition LIKE '{$condition}' AND brand LIKE '{$brand}'";
    }

}// end_home_dao
