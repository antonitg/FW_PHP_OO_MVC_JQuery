<?php
//////
class shop_dao
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
    public function getFiltersSearch($keyword, $brand, $condition, $minprice, $maxprice, $showing, $page, $user)
    {
        if ($user == "null") {
            $user = "guest";
        } else {
            // $JWT = new JWT;
            // $decoded = $JWT->decode($user, $secret);
            // $final = json_decode($decoded, true);
            // $user = $final['name'];
        }
        if ($minprice == "null") {
            $minprice = 100;
        }
        if ($maxprice == "null") {
            $maxprice = 99999999;
        }
        $from = $showing * ($page - 1);
        $typedQuery = "SELECT c.*,v.registrationfav FROM `cars` c LEFT JOIN `favs` v ON v.userfav = '{$user}' AND v.registrationfav=c.registration WHERE `brand` LIKE '{$brand}' AND `carcondition` LIKE '{$condition}' AND `model` LIKE '%{$keyword}%' AND `price` BETWEEN '{$minprice}' AND '{$maxprice}' ORDER BY views desc LIMIT {$from},{$showing}";
        return db::query()->manual($typedQuery)
            ->execute()
            ->queryToArray()
            ->toJSON();
    }
    public function getPagination($keyword, $brand, $condition, $minprice, $maxprice)
    {
    if ($minprice == "null") {
        $minprice = 100;
    }
    if ($maxprice == "null") {
        $maxprice = 99999999;
    }
    $typedQuery = "SELECT * FROM `cars` WHERE `brand` LIKE '{$brand}' AND `carcondition` LIKE '{$condition}' AND `model` LIKE '%{$keyword}%' AND `price` BETWEEN '{$minprice}' AND '{$maxprice}";
    return db::query()->manual($typedQuery)
        ->execute()
        ->queryToArray()
        ->toJSON();
    }
    public function getMapShop($lat, $lon)
    {
        $typedQuery = "SELECT price,carcondition,brand,model,src,lat,lon,registration,ABS(ABS({$lat} - lat)) + ABS(ABS({$lon} - lon)) AS diftotal from cars c LEFT JOIN img i ON i.id=c.registration ORDER BY diftotal LIMIT 5";
        return db::query()->manual($typedQuery)
            ->execute()
            ->queryToArray()
            ->toJSON();
    }
    public function getSearchResults($keyword)
    {
        // $sql = "SELECT * FROM `cars` WHERE `brand` LIKE '%{$keyword}%' OR `model` LIKE '%{$keyword}%' OR `category` LIKE '%{$keyword}%'";
        return db::query()->select(['*'], 'cars')
            ->where(['brand' => ['%' . $keyword . '%'], 'model' => ['%' . $keyword . '%'], 'category' => ['%' . $keyword . '%']], 'OR', 'LIKE')
            ->execute()
            ->queryToArray()
            ->toJSON();
    }
    public function loadFilters()
    {
        $typedQuery = "SELECT brand,count(brand) AS num FROM cars GROUP BY brand ORDER BY count(brand) DESC";
        return db::query()->manual($typedQuery)
            ->execute()
            ->queryToArray()
            ->toJSON();
    }
    public function getDetails($registration)
    {
        // $sql = "SELECT i.src AS srcimg,c.* FROM cars c
        //     RIGHT JOIN img i
        //     ON c.registration=i.id
        //     WHERE registration='$registration'";
        return db::query()->select(['img.src AS srcimg', 'cars.*'], 'cars')
            ->join([['img' => 'id', 'cars' => 'registration']], 'LEFT')
            ->where(['registration' => [$registration]])->execute()->toJSON();
    }
    public function addView($registration)
    {
        // $sql = "UPDATE cars SET views = views + 1 WHERE registration = '{$registration}'";
        return db::query()->update(['views' => 'views + 1'], 'cars')
            ->where(['registration' => [$registration]])->execute()->toJSON();
    }
    public function getCart($user)
    {
        $typedQuery = "SELECT ca.*,c.cartuser,c.insurance,c.cartprice,i.src FROM cart c LEFT JOIN cars ca ON ca.registration=c.registration LEFT JOIN img i ON i.id=c.registration WHERE c.cartuser = '{$user}'";
        return db::query()->manual($typedQuery)
            ->execute()
            ->queryToArray()
            ->toJSON();
    }
    public function addItemCart($user, $registration)
    {
        // $sql = "INSERT INTO `cart`(`cartuser`, `registration`) VALUES ('{$user}','{$registration}')";
        db::query()->insert([['cartuser' => $user, 'registration' => $registration]], 'cart')
            ->execute()
            ->toJSON();
    }
    public function rmItemCart($user, $registration)
    {
        // $sql = "DELETE FROM cart WHERE registration = '{$registration}' AND cartuser = '{$user}'";
        return db::query()->delete('cart')
            ->where(['registration' => [$registration], 'username' => [$user]])
            ->execute()
            ->toJSON();
    }
    public function addItemFav($user, $registration)
    {
        // $sql = "INSERT INTO `favs`(`userfav`, `registrationfav`) VALUES ('{$user}','{$registration}')";
        return db::query()->insert([['userfav' => $user, 'registrationfav' => $registration]], 'favs')
            ->execute()
            ->toJSON();
    }
    public function rmItemFav($user, $registration)
    {
        // $sql = "DELETE FROM favs WHERE registrationfav = '{$registration}' AND userfav = '{$user}'";
        return db::query()->delete('cart')
            ->where(['registrationfav' => [$registration], 'userfav' => [$user]])
            ->execute()
            ->toJSON();
    }
    public function addItemIns($user, $registration)
    {
        // $sql = "UPDATE cart SET insurance = 1 WHERE registration = '{$registration}' AND cartuser = '{$user}'";
        return db::query()->update(['views' => 1], 'cars')
            ->where(['registration' => [$registration], 'cartuser' => [$user]])
            ->execute()
            ->toJSON();

    }
    public function rmItemIns($user, $registration)
    {
        // $sql = "UPDATE cart SET insurance = 0 WHERE registration = '{$registration}' AND cartuser = '{$user}'";
        return db::query()->update(['views' => 0], 'cars')
            ->where(['registration' => [$registration], 'cartuser' => [$user]])
            ->execute()
            ->toJSON();
    }

}
