<?php
//////
class home_dao
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

    function rand_prod(){
        $sql = "SELECT * FROM `cars` AS c LEFT JOIN `img` AS i ON c.registration = i.id ORDER BY RAND() LIMIT 10";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        while($row = $res->fetch_array(MYSQLI_ASSOC)) {
            $resArray[] = $row;
        }
        return $resArray;
    }
    public function incView($brand)
    {
        // return db::query() -> update(['views' => 'views + 1'], 'brandCars') -> where(['brand' => [$brand]]) -> execute();
    } // end_incView
}// end_home_dao