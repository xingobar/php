<?php
include_once('../Proxy/DbConnection/DbConnect.php');

class DB
{
    private static $table;
    private static $sql;
    private static $sort ;
    private static $conn;
    private $conditionArray;

    public function __construct(){
        self::$sort = 'desc';
    }

    public static function table($table){
        self::$conn = DbConnect::connect();
        self::$table = $table;
        self::$sort = 'desc';
        self::$sql = "select * from $table";
        return new DB();
    }

    public function select(){
        $tempSql = " select  ";
        $columns  =func_get_args();
        foreach($columns as $column){
            $tempSql = $tempSql . "  " . $column . ' , ';
        }
        $tempSql = substr($tempSql,0,-2);
        $tempSql = $tempSql . " from " . self::$table;
        self::$sql = $tempSql;
        return $this;
    }

    public function where($column,$operator = '=',$value){
        $this->conditionArray[$value] = $value;
        self::$sql = self::$sql . " where $column $operator :$value";
        return $this;
    }

    public function orWhere($column,$operator = '=',$value){
        $this->conditionArray[$value] = $value;
        self::$sql = self::$sql . " or $column $operator :$value";
        return $this;
    }

    public function whereBetween($column, $firstValue,$secondValue){
        self::$sql = self::$sql . " where $column between $firstValue and $secondValue ";
        return $this;
    }

    public function whereNotBetween($column, $firstValue,$secondValue){
        self::$sql = self::$sql . " where $column not between $firstValue and $secondValue ";
        return $this;
    }

    public function whereIn($column){
        $scopeValues = func_get_args();
        $column = $scopeValues[0];
        $scopeValues = array_slice($scopeValues,1,count($scopeValues));
        $concatScopeValues = " where $column in ( ";
        foreach($scopeValues as $value){
            $concatScopeValues = $concatScopeValues . $value . ' , ' ;
        }
        $concatScopeValues = substr($concatScopeValues , 0 , strlen($concatScopeValues)-2);
        $concatScopeValues .= ' ) ';
        self::$sql = self::$sql . $concatScopeValues;
        return $this;
    }

    public function whereNotIn($column){
        $scopeValues = func_get_args();
        $column = $scopeValues[0];
        $scopeValues = array_slice($scopeValues,1,count($scopeValues));
        $concatScopeValues = " where $column not in ( ";
        foreach($scopeValues as $value){
            $concatScopeValues = $concatScopeValues . $value . ' , ';
        }
        $concatScopeValues = substr($concatScopeValues, 0 , strlen($concatScopeValues) - 2);
        $concatScopeValues .= ' ) ';
        self::$sql = self::$sql . $concatScopeValues;
        return $this;
    }

    public function whereNotNull($column){
        self::$sql  = self::$sql . " where $column is not null";
        return $this;
    }

    public function whereNull($column){
        self::$sql = self::$sql . " where $column is null";
        return $this; 
    }

    public function orderBy($column,$sort = 'asc'){
        self::$sql = self::$sql . " order by $column $sort";
        return $this;
    }

    public function groupBy($column){
        self::$sql = self::$sql . " group by $column";
        return $this; 
    }

    public function get(){
        $query = self::$conn->prepare(self::$sql);
        $query->execute($this->conditionArray);
        $result = $query->fetch();
        self::$conn = null;
        return $result;
    }

    public function getAll(){
        $query = self::$conn->prepare(self::$sql);
        $query->execute($this->conditionArray);
        $results = $query->fetchAll();
        self::$conn = null;
        return $results;
    }
}
echo '<h2>sql where </h2>';
print_r(DB::table('user')->where('user_name','=','gary')->get());
echo "<br/>";

echo '<h2>sql select </h2>';
print_r( DB::table('user')->select('user_name','password')->getAll());
echo '<br/>';

echo '<h2>sql where and or where </h2>';
print_r(DB::table('user')->where('user_name','=','gary')
        ->orWhere('password','=',md5('gary'))->get());
echo '<br/>';

echo '<h2> sql where between </h2>';
print_r(DB::table('user')->whereBetween('id',1,2)->getAll());
echo '<br/>';

echo '<h2> sql where not between </h2>';
print_r(DB::table('user')->whereNotBetween('id',1,2)->getAll());
echo '<br/>';

echo '<h2> sql order by </h2>';
print_r(DB::table('user')->orderBy('id','desc')->getAll());
echo '<br/>';

echo '<h2> sql group by </h2>';
print_r(DB::table('user')->groupBy('id')->getAll());
echo '<br/>';

echo '<h2> sql where in  </h2>';
print_r(DB::table('user')->whereIn('id',2,3)->getAll());
echo '<br/>';

echo '<h2> sql where not in  </h2>';
print_r(DB::table('user')->whereNotIn('id',2,3)->getAll());
echo '<br/>';


echo '<h2> sql where not null  </h2>';
print_r(DB::table('user')->whereNotNull('id')->getAll());
echo '<br/>';

?>